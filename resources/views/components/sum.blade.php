<script>


 function calculate1() {
     var myBox1 = document.getElementById('B1').value;
     var myBox2 = document.getElementById('B16').value;
     var result = document.getElementById('B33');
     var myResult = myBox1 * myBox2;
       document.getElementById('B33').value = myResult;

 }
function calculate2() {
     var myBox1 = document.getElementById('B2').value;
     var myBox2 = document.getElementById('B17').value;
     var result = document.getElementById('B34');
     var myResult = myBox1 * myBox2;
       document.getElementById('B34').value = myResult;

 }
function calculate3() {
     var myBox1 = document.getElementById('B3').value;
     var myBox2 = document.getElementById('B18').value;
     var result = document.getElementById('B35');
     var myResult = myBox1 * myBox2;
       document.getElementById('B35').value = myResult;

 }
function calculate4() {
     var myBox1 = document.getElementById('B4').value;
     var myBox2 = document.getElementById('B19').value;
     var result = document.getElementById('B36');
     var myResult = myBox1 * myBox2;
       document.getElementById('B36').value = myResult;

 }
function calculate5() {
     var myBox1 = document.getElementById('B5').value;
     var myBox2 = document.getElementById('B20').value;
     var result = document.getElementById('B37');
     var myResult = myBox1 * myBox2;
       document.getElementById('B37').value = myResult;

 }
function calculate6() {
     var myBox1 = document.getElementById('B6').value;
     var myBox2 = document.getElementById('B21').value;
     var result = document.getElementById('B38');
     var myResult = myBox1 * myBox2;
       document.getElementById('B38').value = myResult;

 }
function calculate7() {
     var myBox1 = document.getElementById('B7').value;
     var myBox2 = document.getElementById('B22').value;
     var result = document.getElementById('B39');
     var myResult = myBox1 * myBox2;
       document.getElementById('B39').value = myResult;

 }
function calculate8() {
     var myBox1 = document.getElementById('B8').value;
     var myBox2 = document.getElementById('B23').value;
     var result = document.getElementById('B40');
     var myResult = myBox1 * myBox2;
       document.getElementById('B40').value = myResult;

 }
function calculate9() {
     var myBox1 = document.getElementById('B9').value;
     var myBox2 = document.getElementById('B24').value;
     var result = document.getElementById('B41');
     var myResult = myBox1 * myBox2;
       document.getElementById('B41').value = myResult;

 }
function calculate10() {
     var myBox1 = document.getElementById('B10').value;
     var myBox2 = document.getElementById('B25').value;
     var result = document.getElementById('B42');
     var myResult = myBox1 * myBox2;
       document.getElementById('B42').value = myResult;

 }
function calculate11() {
     var myBox1 = document.getElementById('B11').value;
     var myBox2 = document.getElementById('B26').value;
     var result = document.getElementById('B43');
     var myResult = myBox1 * myBox2;
       document.getElementById('B43').value = myResult;

 }
function calculate12() {
     var myBox1 = document.getElementById('B12').value;
     var myBox2 = document.getElementById('B27').value;
     var result = document.getElementById('B44');
     var myResult = myBox1 * myBox2;
       document.getElementById('B44').value = myResult;

 }
function calculate13() {
     var myBox1 = document.getElementById('B13').value;
     var myBox2 = document.getElementById('B28').value;
     var result = document.getElementById('B45');
     var myResult = myBox1 * myBox2;
       document.getElementById('B45').value = myResult;

 }
function calculate14() {
     var myBox1 = document.getElementById('B14').value;
     var myBox2 = document.getElementById('B29').value;
     var result = document.getElementById('B46');
     var myResult = myBox1 * myBox2;
       document.getElementById('B46').value = myResult;

 }
function calculate15() {
     var myBox1 = document.getElementById('B15').value;
     var myBox2 = document.getElementById('B30').value;
     var result = document.getElementById('B47');
     var myResult = myBox1 * myBox2;
       document.getElementById('B47').value = myResult;

 }
</script>

<script>
function update_sum() {
let sum = [...document.querySelectorAll('.txt')].reduce((acc,cur)=>{return Number(cur.value)+acc},0);

document.getElementById("sum-field").textContent = sum;
}
update_sum();
</script>
