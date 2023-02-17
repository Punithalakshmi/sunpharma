var remarksSubmitClicked = false;
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
      
    //successMessageAlert('');
   
    
    // $("#rating").onkeyup(function(){
    //   alert('should');
    // })

   

});

function auto_grow(element) {
  element.style.height = "5px";
  element.style.height = (element.scrollHeight)+"px";
}

function getRemarks(e,type,id)
{

  $("#remarksModal").modal('show'); 

 

   $("#remarksSubmit").on('click',function(e){
 
    //console.log('button click',e);
   /// if()

   var remarksText = $("#remarks").val();

     console.log('remarksText',remarksText);

     nominee_approve(type,id,remarksText);
  
  }); 

}

function nominee_approve(type = '',id='',remarks)
{
  
    
  $("#remarksModal").modal('hide'); 
    var msg = (type && type == 'approve')?'approve':'reject';

    msg = "Are you sure you want to "+msg+" this Nominee?";

    var csrfHash = $("input[name='app_csrf']").val();

    $.confirmModal('<h2>'+msg+'</h2>', {
      messageHeader: '',
      backgroundBlur: ['.container'],
      modalVerticalCenter: true
    },function(el) {
          if(el){
                        
            $('#loader').removeClass('hidden');
            
            $.ajax({
                url : base_url+'/admin/nominee/approve',
                type: "POST",
                data : {type:type,id:id,'app_csrf':csrfHash,'remarks':remarks},
                dataType:'json',
                success: function(data, textStatus, jqXHR)
                {
                  $('#loader').addClass('hidden');
                    if(data.status && data.status == 'success')
                      successMessageAlert(data.message)
    
                      //location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                  $('#loader').addClass('hidden');
                  if(textStatus && textStatus == 'error'){
                   if(jqXHR.responseJSON.message){
                     errorMessageAlert(jqXHR.responseJSON.message);
                     
                     
                   }
                 }
                }
            });

          }
          
        }); 

  
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

    if(category == ''){
      errorMessageAlert('Please select category');
      return false;
   }


    var csrfHash = $("input[name='app_csrf']").val();

    $('#loader').removeClass('hidden');

    $.ajax({
      url : base_url+'/admin/awards/index',
      type: "POST",
      data : {category:category,year:year,'app_csrf':csrfHash},
      dataType:'json',
      success: function(data, textStatus, jqXHR)
      {
        $('#loader').addClass('hidden');
          if(data.data)
            $("#getLists").html(data.data);
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        console.log(jqXHR);
         console.log(textStatus);
         $('#loader').addClass('hidden');
         if(textStatus && textStatus == 'error'){
          if(jqXHR.responseJSON.message){
            errorMessageAlert(jqXHR.responseJSON.message);
           
            
          }
        }
      }

    });


 }

 function exportResult()
 {

    var category = $("#category").val();
    var year     = $("#year").val();
    var csrfHash = $("input[name='app_csrf']").val();
   
    $('#loader').removeClass('hidden');
    $.ajax({
      url : base_url+'/admin/awards/export',
      type: "POST",
      data : {category:category,year:year,'app_csrf':csrfHash},
      dataType:'json',
      success: function(data, textStatus, jqXHR)
      {
        $('#loader').addClass('hidden');
         
          window.location.href = data.filename;
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
         
         $('#loader').addClass('hidden');
         if(textStatus && textStatus == 'error'){
           if(jqXHR.responseJSON.message){
              errorMessageAlert(jqXHR.responseJSON.message); 
           }
         }
          
      }

    });
   
 }

 function geJuryLists(nominee_id = '')
 {
  
    var csrfHash = $("input[name='app_csrf']").val();

      $('#loader').removeClass('hidden');
      $.ajax({
          url : base_url+'/admin/awards/getJuryListsByNominee/'+nominee_id,
          type: "GET",
          data : {'app_csrf':csrfHash},
          dataType:'json',
          success: function(data, textStatus, jqXHR)
          {
              $('#loader').addClass('hidden');
              if(data.status && data.status == 'success'){
                $("#juryListsModal").modal('show');
                $("#juryListsModal #juryListss").html(data.html);
              }
              
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              $("#juryListsModal").hide(); 
              $('#loader').addClass('hidden');
              if(textStatus && textStatus == 'error'){
                if(jqXHR.responseJSON.message){
                  errorMessageAlert(jqXHR.responseJSON.message);
                 
                
                }
              }
          }
      });

 }

function userDelete(type = '',id='',url = '',e)
{
   
  $('#loader').removeClass('block');
    var msg = 'Are you sure you want to delete this '+type+'?';

   // CSRF Hash
  
   var csrfHash = $("input[name='app_csrf']").val(); // CSRF hash  

    console.log('csrfName',csrfHash);
  $.confirmModal('<h2>'+msg+'</h2>', {
    messageHeader: '',
    backgroundBlur: ['.container'],
    modalVerticalCenter: true
  },function(el) {
        if(el){
                $('#loader').removeClass('hidden');
                  $.ajax({
                      url : base_url+url+'/'+id,
                      type: "POST",
                      data : {'app_csrf':csrfHash},
                      dataType:'json',
                      success: function(data, textStatus, jqXHR)
                      {
                        $('#loader').addClass('hidden');
                          if(data.status && data.status == 'success')
                            {
                              
                              if(data.message)
                                successMessageAlert(data.message);
                            }

                            
                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                        $('#loader').addClass('hidden');
                        if(textStatus && textStatus == 'error'){
                          if(jqXHR.responseJSON.message){
                            errorMessageAlert(jqXHR.responseJSON.message);
                            
                           
                          }
                        }
                      }
                  });
                }  
                else
                {
                  return false;
                }
             }
          );    
    
}


function successMessageAlert(msg)
{

    Msg.icon = Msg.ICONS.FONTAWESOME;
    Msg['success'](msg);
  
   setTimeout(function(){
    location.reload();
    },2500);
}

function errorMessageAlert(msg)
{

    Msg.icon = Msg.ICONS.FONTAWESOME;
    Msg['danger'](msg);

    setTimeout(function(){
      location.reload();
      },2500);

}

function juryFinalSubmit(nominee_id = '')
{
   
          $('#loader').removeClass('hidden');
            var msg = 'This is final review submission as it is not editable after that';

            var csrfHash = $("input[name='app_csrf']").val();

            var formData = $("#ratingForm").serialize();

            console.log('formdata',formData);
    
            $.confirmModal('<h2>'+msg+'</h2>', {
              messageHeader: '',
              backgroundBlur: ['.container'],
              modalVerticalCenter: true
            },function(el) {
                if(el){
                  ///admin/nominee/view
                      //  $('#loader').addClass('hidden');
                      $.ajax({
                        url: base_url+'/csrf_token',
                        type: 'GET',
                        data: {},
                        dataType: 'json',
                        success: function (form_res) 
                        {

                            //  $("#overlay").fadeIn(300);

                            token_res = form_res;

                           // var fd = new FormData();

                            var comment = $("#comment").val();
                            var rating  = $("#rating").val();

                        //    fd.append('app_csrf',token_res.token);
                         //   fd.append('comment',comment);
                          //  fd.append('rating',rating);
                                                                                                                                                                                                               
                              $.ajax({
                                url: base_url+'/admin/nominee/view/'+nominee_id,
                                type: "POST",
                                data: {app_csrf:token_res.token,comment:comment,rating:rating},
                                dataType:'json',
                                success: function(data, textStatus, jqXHR)
                                {
                                  $('#loader').addClass('hidden');
                                      if(data.status && data.status == 'success'){
                                        if(data.message)
                                          successMessageAlert(data.message);
                                      }  
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                  $('#loader').addClass('hidden');
                                  if(textStatus && textStatus == 'error'){
                                    if(jqXHR.responseJSON.message){
                                      errorMessageAlert(jqXHR.responseJSON.message);
                                    }
                                  }
                                }
                            });
                       }
                  }); 
                  
                    setTimeout(function(){
                    return true
                    },2500);
                }  
                else
                {
                  return false;
                }
             }
          );    
}



function exportRegistrations()
{
   
  $('#loader').removeClass('block');
    var msg = 'Are you sure you want to export all registration user lists?';
    var csrfHash = $("input[name='app_csrf']").val(); // CSRF hash  

    console.log('csrfName',csrfHash);
    $.confirmModal('<h2>'+msg+'</h2>', {
      messageHeader: '',
      backgroundBlur: ['.container'],
      modalVerticalCenter: true
    },function(el) {
        if(el){
                $('#loader').removeClass('hidden');
                  $.ajax({
                      url : base_url+'/admin/eventregisteration/export',
                      type: "POST",
                      data : {'app_csrf':csrfHash},
                      dataType:'json',
                      success: function(data, textStatus, jqXHR)
                      {
                        $('#loader').addClass('hidden');
                            if(data.status && data.status == 'success'){
                              if(data.message)
                                successMessageAlert(data.message);

                                window.location.href = data.filename;
                            }  
                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                        $('#loader').addClass('hidden');
                        if(textStatus && textStatus == 'error'){
                          if(jqXHR.responseJSON.message){
                            errorMessageAlert(jqXHR.responseJSON.message);
                          }
                        }
                      }
                  });
                }  
                else
                {
                  return false;
                }
             }
          );    
    
}


function getCategories(e)
{
        var mainCategoryID = e.value;
       
        $('#loader').removeClass('hidden');
  
        $.ajax({
            url : base_url+'/admin/nomination/getCategoryById/'+mainCategoryID,
            type: "GET",
            data : {},
            dataType:'json',
            success: function(data, textStatus, jqXHR)
            {
                $('#loader').addClass('hidden');
                if(data.status && data.status == 'success'){
                  $("#awardTypeList").html(data.html);
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
              $('#loader').addClass('hidden');  
            }
        });
}


function getCsrfToken()
{
    $.ajax({
            url: base_url+'/csrf_token',
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function (form_res) 
            {
                return form_res;
            }
    });
    //return true;
}