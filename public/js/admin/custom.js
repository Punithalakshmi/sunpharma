$(document).ready(function(){

    $('#single_cal3').daterangepicker({
        singleDatePicker: true,
        singleClasses: "picker_3"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });

    $('#single_cal2').daterangepicker({
        singleDatePicker: true,
        singleClasses: "picker_2"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
      

   


});



function nominee_approve(type = '',id='')
{
  
    var msg = (type && type == 'approve')?'approve':'reject';
    if(confirm("Are you sure you want to "+msg+" this Nominee?")){
      $('#loader').removeClass('hidden');
        $.ajax({
            url : base_url+'/admin/nominee/approve',
            type: "POST",
            data : {type:type,id:id},
            dataType:'json',
            success: function(data, textStatus, jqXHR)
            {
              $('#loader').addClass('hidden');
                if(data.status && data.status == 'success')
                  alert(data.message);

                  location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert(data.message);
            }
        });
    
}
else
{
    return false;
}

   
}


$(function(){
    $('.selectAll').click(function(){
       if (this.checked) {
          $(".assign_jury_to_nominee").prop("checked", true);
       } else {
          $(".assign_jury_to_nominee").prop("checked", false);
       }	
    });
 });


 function assignJuryToNominee()
 {
    var array = [];
    $("input:checked").each(function() {
        array.push($(this).val());
    });

    var juryID = $("#juryLists").val();
    $('#loader').removeClass('hidden');
    $.ajax({
        url : base_url+'/admin/nominee/assignJury',
        type: "POST",
        data : {nominee:array,juryID:juryID},
        dataType:'json',
        success: function(data, textStatus, jqXHR)
        {

          $('#loader').addClass('hidden');

            if(data.status && data.status == 'success')
              alert(data.message);

            $("#juryListsModal").hide(); 
            location.reload();  
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            $("#juryListsModal").hide(); 
        }
    });

 }


 function categoryRestrictionByRole(ele)
 {
     if(ele.value == 1)
       $("#categorySelection").css("display",'block');
     else
       $("#categorySelection").css("display",'none');  
 }

 function getAwardLists()
 {
   
    var category = $("#category").val();
    var year     = $("#year").val();

    $('#loader').removeClass('hidden');

    $.ajax({
      url : base_url+'/admin/awards/index',
      type: "POST",
      data : {category:category,year:year},
      dataType:'json',
      success: function(data, textStatus, jqXHR)
      {
        $('#loader').addClass('hidden');
          if(data.data)
            $("#getLists").html(data.data);
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        
      }

    });


 }

 function exportResult()
 {

    var category = $("#category").val();
    var year     = $("#year").val();

   
    $('#loader').removeClass('hidden');
    $.ajax({
      url : base_url+'/admin/awards/export',
      type: "POST",
      data : {category:category,year:year},
      dataType:'json',
      success: function(data, textStatus, jqXHR)
      {
        $('#loader').addClass('hidden');
          console.log('data',data.filename);
          window.location.href = data.filename;
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        
      }

    });
   
 }

 function geJuryLists(nominee_id = '')
 {
 
    $('#loader').removeClass('hidden');
    $.ajax({
        url : base_url+'/admin/awards/getJuryListsByNominee/'+nominee_id,
        type: "GET",
        data : {},
        dataType:'json',
        success: function(data, textStatus, jqXHR)
        {
            $('#loader').addClass('hidden');
            if(data.status && data.status == 'success'){
              $("#juryListsModal #juryListss").html(data.html);
            }
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            $("#juryListsModal").hide(); 
        }
    });

 }
