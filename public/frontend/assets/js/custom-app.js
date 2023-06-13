$(function(){
  $('#date_of_birth_spsfn').datepicker({
    yearRange:"1991:+0",
    changeMonth: true,
    changeYear: true
  });
});
 
 $(document).ready(function(){

  //$('#birth-date').mask('00/00/0000');
  //$('#phone-number').mask('0000-0000');

  

 
});

function auto_grow(element) {
  element.style.height = "5px";
  element.style.height = (element.scrollHeight)+"px";
}