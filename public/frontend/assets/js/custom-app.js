$(document).ready(function(){
  $('#birth-date').mask('00/00/0000');
  $('#phone-number').mask('0000-0000');

  $("#date_of_birth_spsfn").datepicker({ 
    yearRange: '1992:c+1' ,
    changeYear: true,
    minDate: new Date(1992, 10 - 1, 25),
    maxDate: '+30Y',
});
});

function auto_grow(element) {
  element.style.height = "5px";
  element.style.height = (element.scrollHeight)+"px";
}