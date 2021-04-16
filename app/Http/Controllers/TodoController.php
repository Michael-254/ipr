<?php

namespace App\Http\Controllers;

use DB;
use App\todo;
use App\step;
use App\User;
use App\image;
use App\supplier;
use App\Notifications\IPR;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPost;
use Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;





class TodoController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }
  //user
  public function todos()
  {
    //$todos = todo::orderby('name','desc')->get();
    $todos = auth()->user()->todo()->orderby('name', 'desc')->get();
    return view('todos.index')->with(['todos' => $todos]);
  }

  public function show($id)
  {
    $todos = todo::find($id);
    return view('todos.show')->with(['todos' => $todos]);
  }

  public function rejected($id)
  {
    $user = auth()->user();
    $todos = todo::find($id);
    return view('todos.showreject')->with(['todos' => $todos, 'user' => $user]);
  }

  public function create()
  {
    $user = auth()->user();
    return view('todos.create')->with(['user' => $user]);
  }
  public function edit($id)
  {
    $todos = todo::find($id);
    return view('todos.edit')->with(['todos' => $todos]);
  }

  public function update(Request $request, $id)
  {
    $todos = todo::find($id);
    if ($todos->status != 'pending') {
      return redirect()->back()->with('error', 'You are not allowed to edit this IPR');
    }
    $todos->update([
      'currency' => $request->currency, 'vat' => $request->VAT,
      'leadT' => $request->leadT, 'explanation' => $request->urgencyE
    ]);
    if ($request->stepName) {
      foreach ($request->stepName as $key => $value) {
        $id = $request->stepId[$key];
        $step = step::find($id);
        $itemD = $request->itemD[$key];
        $UOM = $request->UOM[$key];
        $quantityR = $request->quantityR[$key];
        $unitP = $request->unitP[$key];
        $answer = $request->answer[$key];
        $budget = $request->budget[$key];
        $step->update([
          'step' => $value, 'description' => $itemD, 'uom' => $UOM, 'quantityR' => $quantityR,
          'unitP' => $unitP, 'totalP' => $answer, 'budget' => $budget
        ]);
      }
    }
    if ($request->hasfile('image')) {
      foreach ($request->file('image') as $key => $filename) {
        $filename = $request->image[$key]->getClientOriginalName();
        $path = $request->image[$key]->storeAs('public/images/', $filename);
        $todos->image()->Create(['image' => $filename]);
      }
    }
    Alert::success('All good', 'IPR Updated Successfullly');
    return redirect()->back();
  }

  //Changed
  public function store(Request $request)
  {
    $iprs = auth()->user()->todo()->Create([
      'vat' => $request->VAT, 'currency' => $request->currency, 'department' => $request->department,
      'date_initiated' => $request->initiatedDate, 'initiator' => $request->userN, 'initiator_site' => $request->site, 'leadT' => $request->leadT,
      'explanation' => $request->urgencyE, 'email' => $request->email, 'slmM' => $request->email, 'reviewer' => $request->site_inspector
    ]);
    if ($request->itemN) {
      foreach ($request->itemN as $key => $itemN) {
        $itemD = $request->itemD[$key];
        $UOM = $request->UOM[$key];
        $quantityR = $request->quantityR[$key];
        $unitP = $request->unitP[$key];
        $answer = $request->answer[$key];
        $budget = $request->budget[$key];
        $iprs->step()->Create([
          'step' => $itemN, 'description' => $itemD, 'uom' => $UOM, 'quantityR' => $quantityR,
          'unitP' => $unitP, 'totalP' => $answer, 'budget' => $budget
        ]);
      }
    }
    if ($request->hasfile('image')) {
      foreach ($request->file('image') as $key => $filename) {
        $filename = $request->image[$key]->getClientOriginalName();
        $path = $request->image[$key]->storeAs('public/images/', $filename);
        $iprs->image()->Create(['image' => $filename]);
      }
    }
    $reviewer = $request->reviewer;
    Notification::route('mail', $reviewer)
      ->notify(new IPR(auth()->user(), $iprs));
    Alert::success('All good', 'IPR Created Successfullly');
    return redirect()->back();
  }

  //SLO
  public function kiambereSLO()
  {
    if (auth()->user()->slm != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'Kiambere'],
      ['status', '=', 'pending'],
      ['reviewer', '=', 'SLO']
    ])
      ->orWhere([
        ['initiator_site', '=', 'Kiambere'],
        ['status', '=', 'HOD declined'],
        ['reviewer', '=', 'SLO']
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();

    return view('todos.siteT')->with(['todos' => $todos]);
  }

  public function nyongoroSLO()
  {
    if (auth()->user()->slm != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'Nyongoro'],
      ['status', '=', 'pending'],
      ['reviewer', '=', 'SLO']
    ])
      ->orWhere([
        ['initiator_site', '=', 'Nyongoro'],
        ['status', '=', 'HOD declined'],
        ['reviewer', '=', 'SLO']
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.siteT')->with(['todos' => $todos]);
  }


  public function forksSLO()
  {
    if (auth()->user()->slm != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', '7 Forks'],
      ['status', '=', 'pending'],
      ['reviewer', '=', 'SLO']
    ])
      ->orWhere([
        ['initiator_site', '=', '7 Forks'],
        ['status', '=', 'HOD declined'],
        ['reviewer', '=', 'SLO']
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.siteT')->with(['todos' => $todos]);
  }

  //slm
  public function kiambere()
  {
    if (auth()->user()->slm != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'Kiambere'],
      ['status', '=', 'pending'],
      ['reviewer', '=', 'SLM']
    ])
      ->orWhere([
        ['initiator_site', '=', 'Kiambere'],
        ['status', '=', 'HOD declined'],
        ['reviewer', '=', 'SLM']
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();

    return view('todos.siteT')->with(['todos' => $todos]);
  }

  public function nyongoro()
  {
    if (auth()->user()->slm != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'Nyongoro'],
      ['status', '=', 'pending'],
      ['reviewer', '=', 'SLM']
    ])
      ->orWhere([
        ['initiator_site', '=', 'Nyongoro'],
        ['status', '=', 'HOD declined'],
        ['reviewer', '=', 'SLM']
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.siteT')->with(['todos' => $todos]);
  }

  public function forks()
  {
    if (auth()->user()->slm != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', '7 Forks'],
      ['status', '=', 'pending'],
      ['reviewer', '=', 'SLM']
    ])
      ->orWhere([
        ['initiator_site', '=', '7 Forks'],
        ['status', '=', 'HOD declined'],
        ['reviewer', '=', 'SLM']
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.siteT')->with(['todos' => $todos]);
  }

  public function dokolo()
  {
    if (auth()->user()->slm != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'dokolo'],
      ['status', '=', 'pending'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'dokolo'],
        ['status', '=', 'HOD declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.siteT')->with(['todos' => $todos]);
  }

  public function showSLM($id)
  {
    $users = User::where('hod', true)->get();
    $user = auth()->user();
    $todos = todo::find($id);
    return view('todos.showSLM')->with(['todos' => $todos, 'user' => $user, 'users' => $users]);
  }

  public function updateSLM(Request $request, $id)
  {
    $todos = todo::find($id);
    $todos->update([
      'status' => $request->status, 'vat' => $request->VAT, 'currency' => $request->currency, 'slmN' => $request->slmN,
      'slmD' => $request->slmD, 'slmC' => $request->slmC, 'slmM' => $request->slmM
    ]);
    if ($request->stepName) {
      foreach ($request->stepName as $key => $value) {
        $id = $request->stepId[$key];
        $step = step::find($id);
        $quantityR = $request->quantityR[$key];
        $unitP = $request->unitP[$key];
        $answer = $request->answer[$key];
        $budget = $request->budget[$key];
        $decision = $request->decision[$key];
        $supplier = $request->supplier[$key];
        $step->update([
          'quantityR' => $quantityR,
          'unitP' => $unitP, 'totalP' => $answer, 'budget' => $budget, 'decision' => $decision, 'supplier' => $supplier
        ]);
      }
    }
    if ($request->hasfile('image')) {
      foreach ($request->file('image') as $key => $filename) {
        $filename = $request->image[$key]->getClientOriginalName();
        $path = $request->image[$key]->storeAs('public/images/', $filename);
        $todos->image()->Create(['image' => $filename]);
      }
    }

    if ($request->status == 'SLM approved') {
      $reviewer = $request->reviewer;
      Notification::route('mail', $reviewer)
        ->notify(new IPR(auth()->user(), $todos));
    } else {
      $reviewer = $request->email;
      $data = [
        'title' => 'Kindly note that your IPR was rejected at SLM stage.More Information in the system',
      ];
      mail::send('todos.mail', $data, function ($message) use ($reviewer) {
        $message->to($reviewer)->subject('Rejected IPR');
      });
    }
    Alert::success('All good', 'IPR Reviewed Successfullly');
    return redirect('home');
  }

  //HOD
  public function forestry()
  {
    if (auth()->user()->hod != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['department', '=', 'Forestry'],
      ['status', '=', 'SLM approved']
    ])
      ->orWhere([
        ['department', '=', 'Forestry'],
        ['status', '=', 'SLO approved']
      ])
      ->orWhere([
        ['department', '=', 'Forestry'],
        ['status', '=', 'OP declined'],
      ])
      ->orWhere([
        ['department', '=', 'Forestry'],
        ['status', '=', 'pending'],
        ['initiator_site', '=', 'Head Office'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();

    return view('todos.hodT')->with(['todos' => $todos]);
  }

  public function operation()
  {
    if (auth()->user()->hod != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['department', '=', 'Operations'],
      ['status', '=', 'pending'],
      ['initiator_site', '=', 'Head Office'],
    ])
      ->orWhere([
        ['department', '=', 'Operations'],
        ['status', '=', 'pending'],
        ['initiator_site', '=', 'Kampala'],
      ])
      ->orWhere([
        ['department', '=', 'Operations'],
        ['status', '=', 'SLM approved'],
      ])
      ->orWhere([
        ['department', '=', 'Operations'],
        ['status', '=', 'SLO approved'],
      ])
      ->orWhere([
        ['department', '=', 'Operations'],
        ['status', '=', 'OP declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.hodT')->with(['todos' => $todos]);
  }

  public function communication()
  {
    if (auth()->user()->hod != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'Communications'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'Head Office'],
        ['department', '=', 'Communications'],
        ['status', '=', 'OP declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.hodT')->with(['todos' => $todos]);
  }

  public function ME()
  {
    if (auth()->user()->hod != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'M&E'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'Kampala'],
        ['status', '=', 'pending'],
        ['department', '=', 'M&E'],
      ])
      ->orWhere([
        ['initiator_site', '=', 'Head Office'],
        ['department', '=', 'M&E'],
        ['status', '=', 'OP declined'],
      ])
      ->orWhere([
        ['initiator_site', '=', 'Kampala'],
        ['department', '=', 'M&E'],
        ['status', '=', 'OP declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.hodT')->with(['todos' => $todos]);
  }

  public function it()
  {
    if (auth()->user()->hod != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'IT'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'Head Office'],
        ['status', '=', 'OP declined'],
        ['department', '=', 'IT'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.hodT')->with(['todos' => $todos]);
  }

  public function hr()
  {
    if (auth()->user()->hod != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'HR'],
    ])
      ->orWhere([
        ['initiator_site', '=', 'Head Office'],
        ['status', '=', 'OP declined'],
        ['department', '=', 'HR'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.hodT')->with(['todos' => $todos]);
  }

  public function miti()
  {
    if (auth()->user()->hod != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'Miti Magazines'],
    ])
      ->orWhere([
        ['status', '=', 'OP declined'],
        ['department', '=', 'Miti Magazines'],
      ])
      ->orWhere([
        ['initiator_site', '=', 'Tanzania'],
        ['status', '=', 'pending'],
        ['department', '=', 'Miti Magazines'],
      ])
      ->orWhere([
        ['initiator_site', '=', 'Kampala'],
        ['status', '=', 'pending'],
        ['department', '=', 'Miti Magazines'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.hodT')->with(['todos' => $todos]);
  }

  public function account()
  {
    if (auth()->user()->hod != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['initiator_site', '=', 'Head Office'],
      ['status', '=', 'pending'],
      ['department', '=', 'Accounts'],
    ])
      ->orWhere([
        ['status', '=', 'OP declined'],
        ['department', '=', 'Accounts'],
      ])
      ->orWhere([
        ['initiator_site', '=', 'Kampala'],
        ['status', '=', 'pending'],
        ['department', '=', 'Accounts'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.hodT')->with(['todos' => $todos]);
  }

  public function showHOD($id)
  {
    $user = auth()->user();
    $todos = todo::find($id);
    return view('todos.showHOD')->with(['todos' => $todos, 'user' => $user]);
  }

  public function updateHOD(Request $request, $id)
  {
    $todos = todo::find($id);
    $todos->update([
      'status' => $request->status, 'hodN' => $request->hodN, 'hodM' => $request->hodM,
      'hodD' => $request->hodD, 'hodC' => $request->hodC
    ]);
    if ($request->stepName) {
      foreach ($request->stepName as $key => $value) {
        $id = $request->stepId[$key];
        $step = step::find($id);
        $decision = $request->decision[$key];
        $step->update(['decision' => $decision]);
      }
    }
    if ($request->hasfile('image')) {
      foreach ($request->file('image') as $key => $filename) {
        $filename = $request->image[$key]->getClientOriginalName();
        $path = $request->image[$key]->storeAs('public/images/', $filename);
        $todos->image()->Create(['image' => $filename]);
      }
    }
    if ($request->status == 'HOD declined') {
      $reviewer = $request->slmM;
      $initiator = $request->email;
      $data = [
        'title' => 'Kindly note that your IPR was rejected at HOD stage.More Information in the system',
      ];
      mail::send('todos.mail', $data, function ($message) use ($reviewer, $initiator) {
        $message->to([$reviewer, $initiator])->subject('Rejected IPR');
      });
    }
    Alert::success('All good', 'IPR Reviewed Successfullly');
    return redirect('home');
  }

  //OP
  public function op()
  {
    if (auth()->user()->op != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['status', '=', 'HOD approved'],
    ])
      ->orWhere([
        ['status', '=', 'MD declined'],
      ])
      ->orWhere([
        ['status', '=', 'DFO declined'],
      ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.opT')->with(['todos' => $todos]);
  }

  public function showOperation($id)
  {
    $users = User::where('md', true)->get();
    $user = auth()->user();
    $todos = todo::find($id);
    return view('todos.showOP')->with(['todos' => $todos, 'user' => $user, 'users' => $users]);
  }

  public function updateOP(Request $request, $id)
  {
    $todos = todo::find($id);
    $todos->update(['vat' => $request->VAT, 'currency' => $request->currency]);
    if ($request->stepName) {
      foreach ($request->stepName as $key => $value) {
        $id = $request->stepId[$key];
        $step = step::find($id);
        $quantityR = $request->quantityR[$key];
        $unitP = $request->unitP[$key];
        $answer = $request->answer[$key];
        $budget = $request->budget[$key];
        $decision = $request->decision[$key];
        $supplier = $request->supplier[$key];
        $step->update([
          'quantityR' => $quantityR,
          'unitP' => $unitP, 'totalP' => $answer, 'budget' => $budget, 'decision' => $decision, 'supplier' => $supplier
        ]);
      }
    }
    if ($request->hasfile('image')) {
      foreach ($request->file('image') as $key => $filename) {
        $filename = $request->image[$key]->getClientOriginalName();
        $path = $request->image[$key]->storeAs('public/images/', $filename);
        $todos->image()->Create(['image' => $filename]);
      }
    }
    Alert::success('All good', 'IPR Updated Successfully')->toToast();
    return redirect()->back();
  }

  public function approve(Request $request, $id)
  {
    $todos = todo::find($id);
    $todos->update([
      'status' => $request->status, 'type' => $request->type, 'opN' => $request->opN,
      'opD' => $request->opD, 'opC' => $request->opC, 'opM' => $request->opM
    ]);
    if ($request->status == 'OP approved') {
      $reviewer = $request->reviewer;
      Notification::route('mail', $reviewer)
        ->notify(new IPR(auth()->user(), $todos));
    } else {
      $reviewer = $request->slmM;
      $initiator = $request->email;
      $reviewer2 = $request->hodM;
      $data = [
        'title' => 'Kindly note that your IPR was rejected at Operations stage.More Information in the system',
      ];
      mail::send('todos.mail', $data, function ($message) use ($reviewer, $initiator, $reviewer2) {
        $message->to($reviewer)->cc([$initiator, $reviewer2])->subject('Rejected IPR');
      });
    }
    Alert::success('All good', 'Decision Updated Successfullly');
    return redirect('home');
  }

  //MD
  public function mdO()
  {
    if (auth()->user()->md != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['status', '=', 'OP approved'],
      ['type', '=', 'opex'],
    ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.mdT')->with(['todos' => $todos]);
  }

  public function mdC()
  {
    if (auth()->user()->md != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['status', '=', 'OP approved'],
      ['type', '=', 'capex'],
    ])
      ->orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.mdT')->with(['todos' => $todos]);
  }

  public function showMD($id)
  {
    $user = auth()->user();
    $todos = todo::find($id);
    return view('todos.showMD')->with(['todos' => $todos, 'user' => $user]);
  }

  public function updateMD(Request $request, $id)
  {
    $todos = todo::find($id);
    $todos->update(['status' => $request->status, 'mdN' => $request->mdN, 'mdD' => $request->mdD, 'mdC' => $request->mdC]);
    if ($request->stepName) {
      foreach ($request->stepName as $key => $value) {
        $id = $request->stepId[$key];
        $step = step::find($id);
        $decision = $request->decision[$key];
        $step->update(['decision' => $decision]);
      }
    }
    if ($request->hasfile('image')) {
      foreach ($request->file('image') as $key => $filename) {
        $filename = $request->image[$key]->getClientOriginalName();
        $path = $request->image[$key]->storeAs('public/images/', $filename);
        $todos->image()->Create(['image' => $filename]);
      }
    }
    if ($request->status == 'MD declined' || $request->status == 'DFO declined') {
      $reviewer = $request->slmM;
      $initiator = $request->email;
      $reviewer2 = $request->hodM;
      $reviewer3 = $request->opM;
      $data = [
        'title' => 'Kindly note that your IPR was rejected at Final Stage.More Information in the system',
      ];
      mail::send('todos.mail', $data, function ($message) use ($reviewer, $initiator, $reviewer2, $reviewer3) {
        $message->to([$reviewer, $initiator, $reviewer2, $reviewer3])->subject('Rejected IPR');
      });
    }
    Alert::success('All good', 'Decision Updated Successfullly');
    return redirect('home');
  }

  //FINAL
  public function final()
  {
    if (auth()->user()->op != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::where([
      ['status', '=', 'MD approved'],
    ])
      ->orWhere([
        ['status', '=', 'DFO approved'],
      ])
      ->orderBy('mdD', 'DESC')
      ->get();
    return view('todos.finalT')->with(['todos' => $todos]);
  }

  public function showFinal($id)
  {
    $user = auth()->user();
    $todos = todo::find($id);
    return view('todos.showFinal')->with(['todos' => $todos, 'user' => $user]);
  }

  public function attachment($id)
  {
    $todos = todo::find($id);
    return view('todos.imageFinal')->with(['todos' => $todos]);
  }

  public function complete(Request $request, $id)
  {
    $todos = todo::find($id);
    $todos->update(['printed' => true]);
    return redirect()->back()->with('message', 'Successfully marked as Printed');
  }

  public function incomplete(Request $request, $id)
  {
    $todos = todo::find($id);
    $todos->update(['printed' => false]);
    return redirect()->back()->with('message', 'Marked unprinted');
  }

  //TRACEIPR
  public function trace()
  {
    if (auth()->user()->slm != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = todo::orderBy('date_initiated', 'DESC')
      ->get();
    return view('todos.traceT')->with(['todos' => $todos]);
  }

  //SUPPLIER
  public function supplier()
  {
    $user = auth()->user();
    return view('todos.supplier')->with(['user' => $user]);
  }

  public function storeSupplier(Request $request)
  {
    $iprs = supplier::Create([
      'company' => $request->company, 'box' => $request->box, 'code' => $request->code,
      'city' => $request->city, 'tel' => $request->tel, 'web' => $request->web, 'mail' => $request->mail,
      'contact' => $request->contact, 'nature' => $request->nature, 'location' => $request->location, 'account' => $request->account,
      'bank' => $request->bank, 'branch' => $request->branch, 'swift' => $request->swift, 'Scode' => $request->Scode,
      'number' => $request->number, 'till' => $request->till, 'bill' => $request->bill, 'Cduration' => $request->Cduration, 'Climit' => $request->Climit,
      'intro' => $request->intro, 'site' => $request->site, 'user_id' => auth()->id()
    ]);
    if ($request->hasfile('image')) {
      $filename = $request->image->getClientOriginalName();
      $path = $request->image->storeAs('public/images/', $filename);
      $iprs->update(['file' => $filename]);
    }

    return redirect()->back()->with('message', 'Supplier Created Successfully');
  }

  public function Mysuppliers()
  {
    $todos = supplier::where([
      ['user_id', '=', auth()->id()],
    ])
      ->get();
    return view('todos.mysupplierT')->with(['todos' => $todos]);
  }

  public function showMySupplier($id)
  {
    $todos = supplier::find($id);
    return view('todos.EditSupplier')->with(['todos' => $todos]);
  }

  public function updateMySupplier(Request $request, $id)
  {
    $iprs = supplier::findOrFail($id);
    abort_if($iprs->level != 'HOD declined', 403, 'Cannot Update Unless Rejected');
    $iprs->update([
      'company' => $request->company, 'box' => $request->box, 'code' => $request->code,
      'city' => $request->city, 'tel' => $request->tel, 'web' => $request->web, 'mail' => $request->mail,
      'contact' => $request->contact, 'nature' => $request->nature, 'location' => $request->location, 'account' => $request->account,
      'bank' => $request->bank, 'branch' => $request->branch, 'swift' => $request->swift, 'Scode' => $request->Scode,
      'number' => $request->number, 'till' => $request->till, 'bill' => $request->bill, 'Cduration' => $request->Cduration, 'Climit' => $request->Climit,
      'intro' => $request->intro, 'site' => $request->site, 'user_id' => auth()->id(), 'level' => 'pending'
    ]);
    if ($request->hasfile('image')) {
      $filename = $request->image->getClientOriginalName();
      $path = $request->image->storeAs('public/images/', $filename);
      $iprs->update(['file' => $filename]);
    }

    return redirect()->back()->with('message', 'Supplier Updated Successfully');
  }

  public function viewSupplier()
  {
    if (auth()->user()->md != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = supplier::where([
      ['level', '=', 'pending'],
    ])
      ->get();
    return view('todos.supplierT')->with(['todos' => $todos]);
  }

  public function showSupplier($id)
  {
    $todos = supplier::find($id);
    return view('todos.AuthSupplier')->with(['todos' => $todos]);
  }

  public function SupplierDoc($id)
  {
    $todos = supplier::find($id);
    $filename = $todos->file;
    $path = storage_path('app/public/images/' . $filename);
    return response()->file($path);
  }

  public function updateSupplier($id)
  {
    $iprs = supplier::find($id);
    $iprs->update(['level' => 'allowed']);
    return redirect()->back()->with('message', 'Authorization Successfully');
  }

  public function rejectSupplier($id)
  {
    $iprs = supplier::find($id);
    $iprs->update(['level' => 'HOD declined']);
    return redirect()->back()->with('message', 'Authorization Successfully');
  }

  public function approvedSupplier()
  {
    if (auth()->user()->op != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = supplier::where([
      ['level', '=', 'allowed'],
    ])
      ->get();
    return view('todos.printsupplierT')->with(['todos' => $todos]);
  }

  public function printSupplier($id)
  {
    $todos = supplier::find($id);
    return view('todos.printsupplier')->with(['todos' => $todos]);
  }

  //DASHBOARD
  public function dash()
  {
    $todos = todo::count();
    $pending = todo::where('status', '=', 'pending')->count();
    $approved = todo::orWhere(['status' => 'DFO approved', 'status' => 'MD approved'])->count();
    $it = todo::Where(['status' => 'pending', 'department' => 'IT'])->count();
    $hr = todo::Where(['status' => 'pending', 'department' => 'HR'])->count();
    $com = todo::Where(['status' => 'pending', 'department' => 'Communications'])->count();
    $miti = todo::Where(['status' => 'pending', 'department' => 'Miti Magazines'])->count();
    $op = todo::Where(['status' => 'pending', 'department' => 'Operations'])->count();
    $acc = todo::Where(['status' => 'pending', 'department' => 'Accounts'])->count();
    $fore = todo::Where(['status' => 'pending', 'department' => 'Forestry'])->count();
    return view('todos.dashboard')->with([
      'todos' => $todos, 'pending' => $pending,
      'approved' => $approved, 'it' => $it, 'hr' => $hr, 'com' => $com, 'miti' => $miti, 'op' => $op, 'acc' => $acc, 'fore' => $fore
    ]);
  }

  //FILE
  public function file($id)
  {
    $todos = image::findOrFail($id);
    $filename = $todos->image;
    $path = storage_path('app/public/images/' . $filename);
    return response()->file($path);
  }

  //ADMIN
  public function administrator()
  {
    if (auth()->user()->admin != True) {
      return redirect()->back()->with('error', 'Denied Access');
    }
    $todos = User::get();
    return view('todos.usersT')->with(['todos' => $todos]);
  }
}
