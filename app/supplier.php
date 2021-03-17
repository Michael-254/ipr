<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $fillable = ['level','file','company','box','code',
    'city','tel','web','mail','contact','nature','location','account',
'bank','branch','swift','Scode','number','till',
'bill','Cduration','Climit','intro','site',];
}
