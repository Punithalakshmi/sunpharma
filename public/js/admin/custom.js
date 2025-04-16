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


    userDatatable();
    nomineeDatatable();
    eventDatatable();
    registrationDatatable();
    awardTypeDatatable();
    manageAwardsDatatable();
    postWinnersDatatable();
    juryMappingDatatable();
});

function addMoreRows()
{

    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $(".wrapper"); //Input fields wrapper
    var add_button = $(".add_fields"); //Add button class or ID
    var x = 1; //Initial input field is set to 1
	
	//When user click on add input button
	$(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<div><input type="text" name="input_array_name[]" placeholder="Input Text Here" /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
        }
    });
	
    //when user click on remove button
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();
		$(this).parent('div').remove(); //remove inout field
		x--; 
    });
}

function auto_grow(element) {
  element.style.height = "5px";
  element.style.height = (element.scrollHeight)+"px";
}

function getRemarks(e,type,id)
{

  $("#remarksModal").modal('show'); 

   $("#remarksSubmit").on('click',function(e){
 
   var remarksText = $("#remarks").val();

   if(remarksText == ''){
    alert('Please enter text');
    return false;
   } 

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
                      successMessageAlert(data.message);
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
   
   // var category = $("#category").val();
    var main_category_id = $("#main_category_id").val();
    var csrfHash = $("input[name='app_csrf']").val();

    $('#loader').removeClass('hidden');

    $.ajax({
      url: base_url+'/csrf_token',
      type: 'GET',
      data: {},
      dataType: 'json',
      success: function (form_res) 
      {
        $.ajax({
          url : base_url+'/admin/awards/index',
          type: "POST",
          data : {main_category_id:main_category_id,'app_csrf':form_res.token},
          dataType:'json',
          success: function(data, textStatus, jqXHR)
          {
            $('#loader').addClass('hidden');
              if(data.data)
                $("#getLists").html(data.data);
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

 function exportResult()
 {

   // var category = $("#award_title").val();
    var main_category_id = $("#main_category_id").val();
    var year = $("#year").val(); 

    if(main_category_id == ''){
      errorMessageAlert('Please select fellowship!'); 
      return false
    }   

    $("#loader").removeClass('hidden');

    $('#loader').removeClass('block');
    var msg = 'Are you sure you want to export nomination lists?';

    $.confirmModal('<h2>'+msg+'</h2>', {
      messageHeader: '',
      backgroundBlur: ['.container'],
      modalVerticalCenter: true
    },function(el) {
      if(el){
          $.ajax({
            url: base_url+'/csrf_token',
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function (form_res) 
            {
        
              $.ajax({
                url : base_url+'/admin/awards/export',
                type: "POST",
                data : {'app_csrf':form_res.token,'main_category_id':main_category_id},
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
                        location.reload();
                    }
                  }
                }
              }); 
            }
          });   
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
  $.confirmModal('<h2>'+msg+'</h2>', {
    messageHeader: '',
    backgroundBlur: ['.container'],
    modalVerticalCenter: true
  },function(el) {
        if(el){
                $('#loader').removeClass('hidden');
                  if(type == 'user')
                    checkIfNominationClosed(url,id);
                  else if(type == 'registration')  
                    checkIfEventClosed(url,id);
                  else
                    deleteData(csrfHash,url,id);
            }  
            else
            {
              return false;
            }
        }
    );    
}

function checkIfNominationClosed(url,id)
{
  $.ajax({
    url : base_url+'/admin/user/checkIfNominationClosed/'+id,
    type: "GET",
    dataType:'json',
    success: function(data, textStatus, jqXHR)
    {
      $('#loader').addClass('hidden');
          if(data.status && data.status == 'success'){
            if(data.message)
              successMessageAlert(data.message);
          } 
          else
          {
              if(confirm(data.message)) {
                userDeleteMt(url,id);
              } 
              else 
              {
                successMessageAlert('You have cancelled to delete the user!');
              }   
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


function checkIfEventClosed(url,id)
{
  $.ajax({
    url : base_url+'/admin/eventregisteration/checkIfEventIsCompleted/'+id,
    type: "GET",
    dataType:'json',
    success: function(data, textStatus, jqXHR)
    {
      $('#loader').addClass('hidden');
          if(data.status && data.status == 'success'){
            if(data.message)
              successMessageAlert(data.message);
          } 
          else
          {
              if(confirm(data.message)) {
                userDeleteMt(url,id);
              } 
              else 
              {
                successMessageAlert('You have cancelled to delete the user!');
              }    
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

function userDeleteMt(url = '',id='')
{
  $.ajax({
    url : base_url+url+'/'+id,
    type: "GET",
    dataType:'json',
    success: function(data, textStatus, jqXHR)
    {
      $('#loader').addClass('hidden');
          if(data.status && data.status == 'success'){
            if(data.message)
              successMessageAlert(data.message);
          } 
          else
          {
             errorMessageAlert(data.message);
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

function deleteData(csrfHash,url,id)
{
  
  $.ajax({
    url : base_url+url+'/'+id,
    type: "POST",
    data : {app_csrf:csrfHash},
    dataType:'json',
    success: function(data, textStatus, jqXHR)
    {
      $('#loader').addClass('hidden');
      if(data.message)
        successMessageAlert(data.message);
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
                
                      $.ajax({
                        url: base_url+'/csrf_token',
                        type: 'GET',
                        data: {},
                        dataType: 'json',
                        success: function (form_res) 
                        {

                            token_res = form_res;

                            var comment = $("#comment").val();
                            var rating  = $("#rating").val();
                                                                                                                                                                                                               
                              $.ajax({
                                url: base_url+'/'+uri+'/nominee/view/'+nominee_id,
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

      $.confirmModal('<h2>'+msg+'</h2>', {
        messageHeader: '',
        backgroundBlur: ['.container'],
        modalVerticalCenter: true
      },function(el) {
        if(el){

          $("#loader").removeClass('hidden');
    
          $.ajax({
            url: base_url+'/csrf_token',
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function (form_res) 
            {
                $('#loader').removeClass('hidden');
                var title  = $('#title').val();
                var mode = $('#mode').val();

                  $.ajax({
                      url : base_url+'/admin/eventregisteration/export',
                      type: "POST",
                      data : {'app_csrf':form_res.token,title:title,mode:mode},
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
		  $("#award_title").html(data.html);
		  $("#submittedTotal").html(data.submittedTotal);
		 		  $("#unsubmittedTotal").html(data.unSubmittedTotal);
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
   
}


function userDatatable()
{
  
          var empTable = $('#userDatatable').DataTable({
                  'processing': true,
                  'serverSide': true,
                  'serverMethod': 'post',
                  'searching': true, // Remove default Search Control
                  "aaSorting": [],
                  'ajax': {
                       'url': base_url+'/admin/user',
                       'data': function(data){
                               // CSRF Hash
                               var csrfHash = $("input[name='app_csrf']").val();
                               
                               var role = $('#role_name').val();
                               var category = $('#category').val();
                               var firstname = $('#firstname').val();
                               var email = $('#email').val();
                               var year = $('#year').val();

                                data.role_name = role;
                                data.category  = category;
                                data.firstname = firstname;
                                data.email = email;
                                data.year = year;

                              console.log('datatables',data);
                               return {
                                    data: data,
                                    app_csrf: csrfHash // CSRF Token
                               };
                       },
                       dataSrc: function(data){

                            // Update token hash
                            $("input[name='app_csrf']").val(data.token);

                            console.log('filtered data',data.data);
                            // Datatable data
                            return data.data;
                       }
                  },
                  'columns': [
                       { data: 'firstname' },
                       { data: 'lastname' },
                       { data: 'username' },
                       { data: 'email' },
                       { data: 'phone' },
                     //  { data: 'category' },
                       { data: 'role_name' },
                       { data: 'created_date' },
                       { data: 'action',render:function(data,type,row) {
                       // btn = '<a href="'+base_url+'/admin/user/add/'+row.id+'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a><a onclick="userDelete(\'user\','+row.id+',\'/admin/user/delete\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a><a href="'+base_url+'/admin/user/changepassword/'+row.id+'" class="btn btn-info btn-xs"><i class="fa fa-key"></i> Change Password </a>';
		        btn = '<a href="'+base_url+'/admin/user/add/'+row.id+'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a><a href="'+base_url+'/admin/user/changepassword/'+row.id+'" class="btn btn-info btn-xs"><i class="fa fa-key"></i> Change Password </a>';

                        return btn;
                      }},
                  ]
          });

          $('#firstname').keyup(function(){
            empTable.draw();
         });

        $('#email').keyup(function(){
          empTable.draw();
        });

        $('#year').keyup(function(){
          empTable.draw();
        });
          // Custom filter
          $('#role_name').change(function(){
               empTable.draw();
          });

          $('#category').change(function(){
            empTable.draw();
       });

}


function nomineeDatatable()
{
  
      var empTable = $('#nomineeDatatable').DataTable({
	      'processing': true,
              'serverSide': true,
		"bSort" : false,
              'serverMethod': 'post',
              'searching': true, // Remove default Search Control
               'ajax': {
                    'url': base_url+'/admin/nominee',
                    'data': function(data){
                            // CSRF Hash
                            var csrfHash = $("input[name='app_csrf']").val();
                            
                            var award_title = $('#award_title').val();
                            var year = $('#year').val();
                            var firstname = $('#firstname').val();
                            var email = $('#email').val();
                            var main_category_id = $("#main_category_id").val();

                            data.award_title = award_title;
                            data.year  = year;
                            data.firstname = firstname;
                            data.email = email;
                            data.main_category_id = main_category_id;

                                                   return {
                                data: data,
                                app_csrf: csrfHash // CSRF Token
                            };
                    },
                    dataSrc: function(data){

                        // Update token hash
                        $("input[name='app_csrf']").val(data.token);

                        console.log('filtered data',data.data);
                        // Datatable data
                        return data.data;
                    }
              },
              'columns': [
                    { data: 'registration_no' },
                    { data: 'main_category_name' },
                    { data: 'category_name' },
                    { data: 'title' },
                    { data: 'firstname' },
                    { data: 'username' },
                    { data: 'email' },
                    { data: 'phone' },
                    { data: 'status' },
                    /*{ data: 'created_date' },*/
                    { data: 'action',render:function(data,type,row) {
                      console.log('row',row);
                      btn = '<a href="'+base_url+'/admin/nominee/view/'+row.id+'" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View</a>';
                      if(row.is_expired == 'yes' && row.submitted==0){
                        btn += '<a href="'+base_url+'/admin/nominee/extend/'+row.id+'" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Extend Nomination</a>';
                      }
                      if(row.active == 0 && row.status_from_db == 'Disapproved' && row.is_rejected == 0){
                        btn +='<button type="button" onclick="getRemarks(this,\'approve\','+row.id+')" class="btn btn-success greenbg btn-xs">Approve</button><button type="button" class="btn btn-danger btn-xs" onclick="getRemarks(this,\'disapprove\','+row.id+')"><i class="fa fa-ban"></i> Reject</button>'
                      }
		      if(row.is_carry_forward == 'Yes' && row.is_carry_forwarded == 0){
                        btn +='<button type="button" onclick="carryForward(this,\'forward\','+row.id+')" class="btn btn-success greenbg btn-xs">Carry Forward</button>';
                       // btn += '<a href="'+base_url+'/admin/nominee/carryForwardToNextYear/'+row.id+'" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Carry Forward</a>';
                      }	
                      return btn;
                    }},
              ],
	
      });

      $('#firstname').keyup(function(){
        empTable.draw();
      });

    $('#email').keyup(function(){
      empTable.draw();
    });
      // Custom filter
      $('#award_title').change(function(){
            empTable.draw();
      });

      $('#year').keyup(function(){
        empTable.draw();
      });
      
      $('#main_category_id').change(function(){
        empTable.draw();
      });

}

function eventDatatable()
{
  
      var empTable = $('#eventDatatable').DataTable({
              'processing': true,
              'serverSide': true,
              'serverMethod': 'post',
              'searching': false, // Remove default Search Control
              'ajax': {
                    'url': base_url+'/admin/workshops',
                    'data': function(data){

                            // CSRF Hash
                            var csrfHash = $("input[name='app_csrf']").val();
                            
                            var title  = $('#title').val();
                            var status = $('#status').val();
                          //  var start_date = $('#start_date').val();
                            var subject = $('#subject').val();
				 var year = $('#year').val();


                            data.title      = title;
                            data.status     = status;
                           // data.start_date = start_date;
                            data.subject    = subject;
			    data.year = year;	
			

                          console.log('datatables',data);
                            return {
                                data: data,
                                app_csrf: csrfHash // CSRF Token
                            };
                    },
                    dataSrc: function(data){
                        // Update token hash
                        $("input[name='app_csrf']").val(data.token);
                        // Datatable data
                        return data.data;
                    }
              },
              'columns': [
                    { data: 'title' },
                    { data: 'subject' },
                    { data: 'description' },
                    { data: 'start_date' },
                    { data: 'end_date' },
                    { data: 'created_date'},
                    { data: 'action',render:function(data,type,row) {
                      btn = '<button type="button" onclick="setLimit(\'Event\','+row.id+',\'/admin/workshops/onsite_user_limit/\')" class="btn btn-info btn-xs"><i class="fa fa-ban"></i> Set Limit</button><a href="'+base_url+'/admin/workshops/add/'+row.id+'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a><a onclick="userDelete(\'Event\','+row.id+',\'/admin/workshops/delete/\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>';
                      return btn;
                    }},
              ]
      });

      $('#title').change(function(){
        empTable.draw();
      });

      $('#status').keyup(function(){
        empTable.draw();
      });
      // Custom filter
      $('#subject').change(function(){
            empTable.draw();
      });
	
	 $('#year').keyup(function(){
        empTable.draw();
      });


      $('#start_date').keyup(function(){
        empTable.draw();
      });

}

function registrationDatatable()
{
  
      var empTable = $('#registrationDatatable').DataTable({
              'processing': true,
              'serverSide': true,
              'serverMethod': 'post',
              'searching': false, // Remove default Search Control
              'ajax': {
                    'url': base_url+'/admin/eventregisteration',
                    'data': function(data){

                            // CSRF Hash
                            var csrfHash = $("input[name='app_csrf']").val();
                            
                            var title  = $('#title').val();
                           // var email = $('#email').val();
                         //   var phone = $('#phone').val();
                            var mode = $('#mode').val();
			    var year = $('#year').val();
       
                            data.title      = title;
                          //  data.email     = email;
                           // data.start_date = start_date;
                          //  data.phone    = phone;
                            data.mode    = mode;
			    data.year    = year;
	

                          console.log('datatables',data);
                            return {
                                data: data,
                                app_csrf: csrfHash // CSRF Token
                            };
                    },
                    dataSrc: function(data){
                        // Update token hash
                        $("input[name='app_csrf']").val(data.token);
                        // Datatable data
                        return data.data;
                    }
              },
              'columns': [
                    { data: 'title' },
                    { data: 'created_date' },
                    { data: 'registeration_no' },
                    { data: 'firstname' },
                    { data: 'lastname' },
                    { data: 'email'},
                    { data: 'phone'},
                    { data: 'address'},
                    { data: 'mode'},
                    { data: 'action',render:function(data,type,row) {
                      btn = '<a href="'+base_url+'/admin/eventregisteration/add/'+row.id+'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a><a onclick="userDelete(\'registration\','+row.id+',\'/admin/eventregisteration/delete\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>';
                      return btn;
                    }},
              ]
      });

      $('#title').change(function(){
        empTable.draw();
      });
	 $('#year').keyup(function(){
        empTable.draw();
      });


      // $('#email').keyup(function(){
      //   empTable.draw();
      // });
      // // Custom filter
      // $('#phone').keyup(function(){
      //       empTable.draw();
      // });

      $('#mode').change(function(){
        empTable.draw();
      });

}


function awardTypeDatatable()
{
  
      var empTable = $('#awardTypeDatatable').DataTable({
              'processing': true,
              'serverSide': true,
              'serverMethod': 'post',
              'searching': false, // Remove default Search Control
              'ajax': {
                    'url': base_url+'/admin/category',
                    'data': function(data){

                            // CSRF Hash
                            var csrfHash = $("input[name='app_csrf']").val();
                            
                            var award  = $("#main_category_id").val();
                            data.award = award;
                          
                          console.log('datatables',data);
                            return {
                                data: data,
                                app_csrf: csrfHash // CSRF Token
                            };
                    },
                    dataSrc: function(data){
                        // Update token hash
                        $("input[name='app_csrf']").val(data.token);
                        // Datatable data
                        return data.data;
                    }
              },
              'columns': [
                    { data: 'name' },
                    { data: 'type' },
                    { data: 'status' },
                    { data: 'created_date' },
                    { data: 'action',render:function(data,type,row) {
                      btn = '<a href="'+base_url+'/admin/category/add/'+row.id+'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a><a onclick="userDelete(\'award type\','+row.id+',\'/admin/category/delete\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>';
                      return btn;
                    }},
              ]
      });

      $("#main_category_id").change(function(){
        empTable.draw();
      });
      
}


function manageAwardsDatatable()
{
  
      var empTable = $('#manageAwardsDatatable').DataTable({
              'processing': true,
              'serverSide': true,
              'serverMethod': 'post',
              'searching': false, // Remove default Search Control
              'ajax': {
                    'url': base_url+'/admin/nomination',
                    'data': function(data){

                            // CSRF Hash
                            var csrfHash = $("input[name='app_csrf']").val();
                            
                            var title  = $("#title").val();
                            var subject  = $("#subject").val();
                            var award  = $("#award").val();
                            var type  = $("#type").val();

                            data.award = award;
                            data.subject = subject;
                            data.title = title;
                            data.type = type;
                          
                            console.log('datatables',data);
                            return {
                                data: data,
                                app_csrf: csrfHash // CSRF Token
                            };
                    },
                    dataSrc: function(data){
                        // Update token hash
                        $("input[name='app_csrf']").val(data.token);
                        // Datatable data
                        return data.data;
                    }
              },
              'columns': [
                    { data: 'main_category_id' },
                    { data: 'category_id' },
                    { data: 'title' },
                    { data: 'subject' },
                    { data: 'start_date' },
                    { data: 'end_date' },
                    { data: 'status' },
                    { data: 'action', render:function(data,type,row) {
                      btn = '<a href="'+base_url+'/admin/nomination/add/'+row.id+'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a><a onclick="userDelete(\'award\','+row.id+',\'/admin/nomination/delete/\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a><a onclick="assignedJuries('+row.id+')"  class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View Mapped Juries </a> <a href="'+base_url+'/admin/nomination/extendNomination/'+row.id+'"  class="btn btn-info btn-xs"><i class="fa fa-edit"></i>Extend Nomination</a>';
                      return btn;
                    }},
              ]
      });

      $("#award").change(function(){
        empTable.draw();
      });

      $("#title").change(function(){
        empTable.draw();
      });

      $("#type").change(function(){
        empTable.draw();
      });

      $("#subject").change(function(){
        empTable.draw();
      });
      
}


function postWinnersDatatable()
{
  
      var empTable = $('#postWinnersDatatable').DataTable({
              'processing': true,
              'serverSide': true,
              'serverMethod': 'post',
              'searching': false, // Remove default Search Control
              'ajax': {
                    'url': base_url+'/admin/winners',
                    'data': function(data){

                            // CSRF Hash
                            var csrfHash = $("input[name='app_csrf']").val();
                            
                            var year  = $("#year").val();
                            var award  = $("#award").val();
                            var type  = $("#type").val();

                            data.award = award;
                            data.year = year;
                            data.type = type;
                          
                          console.log('datatables',data);
                            return {
                                data: data,
                                app_csrf: csrfHash // CSRF Token
                            };
                    },
                    dataSrc: function(data){
                        // Update token hash
                        $("input[name='app_csrf']").val(data.token);
                        // Datatable data
                        return data.data;
                    }
              },
              'columns': [
                    { data: 'name' },
                    { data: 'main_category' },
                    { data: 'category' },
                    { data: 'photo' },
                    { data: 'designation' },
                    { data: 'year' },
                    { data: 'status' },
                    { data: 'action',render:function(data,type,row) {
                      btn = '<a href="'+base_url+'/admin/winners/add/'+row.id+'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a><a onclick="userDelete(\'Winner\','+row.id+',\'/admin/winners/delete/\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>';
                      return btn;
                    }},
              ]
      });
      $("#award").change(function(){
        empTable.draw();
      });

      $("#type").change(function(){
        empTable.draw();
      });

      $("#year").keyup(function(){
        empTable.draw();
      });
      
}

function addMoreRows(selectorID='',fieldName = '',className = '')
{
     var len = $("."+className).length;
     
     var field = len + 1;

     var removeBtnID = "#"+selectorID+"row"+field;

    $('#'+selectorID).append('<div id="'+selectorID+'row'+field+'"><input class="form-control mb-3 required '+className+'" id="'+fieldName+field+'" accept=".pdf" name="'+fieldName+'[]" type="file" /><button type="button" name="remove" id="'+field+'" class="btn btn-danger btn_remove" onclick="removeButton(\''+removeBtnID+'\','+field+');">X</button></div>');
   
}

function removeButton(id = ''){
 
  $(id).remove();
}

function removeFile(filename='',user_id='',div_id='',field='',id=''){

 
  msg = "Are you sure you want to delete this File?";

  var csrfHash = $("input[name='app_csrf']").val();

  $.confirmModal('<h2>'+msg+'</h2>', {
    messageHeader: '',
    backgroundBlur: ['.container'],
    modalVerticalCenter: true
  },function(el) {
        if(el){
                      
          $('#loader').removeClass('hidden');
          $("#"+div_id).remove();
          
          $.ajax({
              url : base_url+'/admin/nominee/removeFile',
              type: "POST",
              data : {filename:filename,user_id:user_id,'app_csrf':csrfHash,div_id:div_id,field:field,id:id},
              dataType:'json',
              success: function(data, textStatus, jqXHR)
              {
                $('#loader').addClass('hidden');
                  if(data.status && data.status == 'success')
                    successMessageAlert(data.message);

                    window.location.href = base_url+'/admin/nominee/update/'+user_id;
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

function setLimit(type,id,url)
{

    $("#setLimitModal").modal('show'); 

    $("#setLimitSubmit").on('click',function(e){
  
    var remarksText = $("#limit").val();

    if(remarksText == ''){
      alert('Please enter limit');
      return false;
    }
    setUserLimit(type,id,url,remarksText);
  
  }); 

}


function setUserLimit(type = '',id='',url = '',limit='')
{
   
    $('#loader').removeClass('block');
    var msg = 'Are you sure you want to set Onsite user registration limit to this event?';

  $.confirmModal('<h2>'+msg+'</h2>', {
    messageHeader: '',
    backgroundBlur: ['.container'],
    modalVerticalCenter: true
  },function(el) {
        if(el){
              $('#loader').removeClass('hidden');

              // $.ajax({
              //   url: base_url+'/csrf_token',
              //   type: 'GET',
              //   data: {},
              //   dataType: 'json',
              //   success: function (form_res) 
              //   {
              //     var token = form_res.token;
                
                $.ajax({
                    url : base_url+url+limit+"/"+id,
                    type: "GET",
                  //  data : {'app_csrf':token,limit:limit,id:id},
                    dataType:'json',
                    success: function(data, textStatus, jqXHR)
                    {
                          $('#loader').addClass('hidden');
                          if(data.status && data.status == 'success'){
                            if(data.message)
                              successMessageAlert(data.message);
                          } 
                          else
                          {
                              errorMessageAlert(data.message);
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
                //  }
              //  });
            
              }  
              else
              {
                return false;
              }
          }
      );    
}



function juryMappingDatatable()
{
  
      var empTable = $('#juryMappingDatatable').DataTable({
              'processing': true,
              'serverSide': true,
              'serverMethod': 'post',
              'searching': false, // Remove default Search Control
              'ajax': {
                    'url': base_url+'/admin/mappedjuries',
                    'data': function(data){

                            // CSRF Hash
                            var csrfHash = $("input[name='app_csrf']").val();
                            
                            var jury  = $("#jury").val();
                            var award  = $("#award").val();
                           
                            data.award = award;
                            data.jury = jury;
                           
                          console.log('datatables',data);
                            return {
                                data: data,
                                app_csrf: csrfHash // CSRF Token
                            };
                    },
                    dataSrc: function(data){
                        // Update token hash
                        $("input[name='app_csrf']").val(data.token);
                        // Datatable data
                        return data.data;
                    }
              },
              'columns': [
                { data: 'jury' },
                    { data: 'award' },
                   
                    // { data: 'action',render:function(data,type,row) {
                    //   btn = '<a href="'+base_url+'/admin/winners/add/'+row.id+'" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a><a onclick="userDelete(\'Winner\','+row.id+',\'/admin/winners/delete/\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>';
                    //   return btn;
                    // }},
              ]
      });
      $("#award").change(function(){
        empTable.draw();
      });

      $("#jury").change(function(){
        empTable.draw();
      });
     
}

function assignedJuries(award_id ='')
{
 
      $('#loader').removeClass('hidden');
      $.ajax({
          url : base_url+'/admin/nomination/assigned_jury_lists/'+award_id,
          type: "GET",
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

 function removeJuryFromAward(id='')
 {

  $('#loader').removeClass('hidden');
  $.ajax({
      url : base_url+'/admin/nomination/remove_jury_from_award/'+id,
      type: "GET",
      dataType:'json',
      success: function(data, textStatus, jqXHR)
      {
          $('#loader').addClass('hidden');
          if(data.status && data.status == 'success'){
            $("#juryListsModal").hide(); 
            if(data.message)
              successMessageAlert(data.message);
          } 
          else
          {
              errorMessageAlert(data.message);
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


 function exportNominationLists()
 {
    var category = $("#category").val();
    var main_category_id = $("#main_category_id").val();

    if(main_category_id == ''){
       errorMessageAlert('Please select fellowship!'); 
       return false
    }   

    $("#loader").removeClass('hidden');

    $('#loader').removeClass('block');
    var msg = 'Are you sure you want to export nomination lists?';

    var csrfHash = $("input[name='app_csrf']").val();   

    $.confirmModal('<h2>'+msg+'</h2>', {
      messageHeader: '',
      backgroundBlur: ['.container'],
      modalVerticalCenter: true
    },function(el) {
      if(el){
          $.ajax({
            url: base_url+'/csrf_token',
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function (form_res) 
            {
                $.ajax({
                  url : base_url+'/admin/nominee/export',
                  type: "POST",
                  data : {category:category,'app_csrf':form_res.token,'main_category_id':main_category_id},
                  dataType:'json',
                  success: function(data, textStatus, jqXHR)
                  {
                      $('#loader').addClass('hidden');
                      window.location.href = data.filename;
			setTimeout(
  function() 
  {
    location.reload();  }, 5000);
			
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    $('#loader').addClass('hidden');
                    if(textStatus && textStatus == 'error'){
                      if(jqXHR.responseJSON.message){
                          errorMessageAlert(jqXHR.responseJSON.message); 
                          location.reload();
                      }
                    }   
                  }
                }); 
              }
          });   
        }
      } 
    ); 
 }

function exportNominationStatusLists(submit='')
 {
    var category = $("#category").val();
    var main_category_id = $("#main_category_id").val();

    if(main_category_id == ''){
       errorMessageAlert('Please select fellowship!'); 
       return false
    }   
   var submit = submit;
    $("#loader").removeClass('hidden');

    $('#loader').removeClass('block');
    var msg = 'Are you sure you want to export nomination status lists?';

    var csrfHash = $("input[name='app_csrf']").val();   

    $.confirmModal('<h2>'+msg+'</h2>', {
      messageHeader: '',
      backgroundBlur: ['.container'],
      modalVerticalCenter: true
    },function(el) {

      if(el){
          $.ajax({
            url: base_url+'/csrf_token',
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function (form_res) 
            {
                $.ajax({
                  url : base_url+'/admin/nominee/statuslists',
                  type: "POST",
                  data : {'category':category,'app_csrf':form_res.token,'main_category_id':main_category_id,'submitted':submit},
                  dataType:'json',
                  success: function(data, textStatus, jqXHR)
                  {
	              //alert(data.filename);
                      $('#loader').addClass('hidden');
                      window.location.href = data.filename;
		setTimeout(
  function() 
  {
    location.reload();  }, 5000);

		     // location.reload();
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    $('#loader').addClass('hidden');
                    if(textStatus && textStatus == 'error'){
                      if(jqXHR.responseJSON.message){
                          errorMessageAlert(jqXHR.responseJSON.message); 
                          location.reload();
                      }
                    }   
                  }
                }); 
              }
          });   
        }
      } 
    ); 
 }


 function extendNomination(award_id ='')
{
 
      $('#loader').removeClass('hidden');
      $.ajax({
          url : base_url+'/admin/nomination/extendNomination/'+award_id,
          type: "GET",
          dataType:'json',
          success: function(data, textStatus, jqXHR)
          {
              $('#loader').addClass('hidden');
              if(data.status && data.status == 'success'){
                
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


function carryForward(e = '',type='',id = '',name='')
{ 
  $('#loader').removeClass('block');
  var msg = "Are you sure you want to carry forward this nominee to the current year's nomination?";

   // CSRF Hash  
  var csrfHash = $("input[name='app_csrf']").val(); // CSRF hash  
  $.confirmModal('<h2>'+msg+'</h2>', {
    messageHeader: '',
    backgroundBlur: ['.container'],
    modalVerticalCenter: true
  },function(el) {
        if(el){
                  $('#loader').removeClass('hidden');
                  $.ajax({
                    url : base_url+'/admin/nominee/carryForwardToNextYear/'+id,
                    type: "GET",
                    data : {},
                    dataType:'json',
                    success: function(data, textStatus, jqXHR)
                    {
                      $('#loader').addClass('hidden');
                        if(data.status && data.status == 'success')
                          successMessageAlert(data.message);
      
                          
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