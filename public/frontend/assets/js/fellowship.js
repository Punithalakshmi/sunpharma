
const progress = (value) => {
    document.getElementsByClassName('progress-bar')[0].style.width = `${value}%`;
}


$(document).ready(function(){   
var form = $("#formsection");



additionalMethods();

form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {
                    nominator_photo: 
                    {
                        extension: "jpg,png,jpeg",
                        filesize: 500
                    },	
                    justification_letter:
                    {
                        extension: "pdf",
                        filesize: 500
                    },
                    mobile_no:
                    {
                        minlength:10,
                        maxlength:10
                    },
                    nominator_mobile:
                    {
                        minlength:10,
                        maxlength:10
                    },
		    minimum_qualification:{
			eligibleType:'MBBS'
		 }	
            },
            messages: 
            { 
		nominator_photo:{
                    filesize:" Nominator Photo should be size 500KB."
                },
                justification_letter:{
                    filesize:"Justification Letter file size should be 500KB"
                },
		minimum_qualification:{
           		 eligibleType: "MBBS is the minimum qualification for registration"
        	}

            } 
    });

    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
          
           
            form.validate().settings.ignore = ":disabled,:hidden";
           
            // Get the selected file
            if(currentIndex && currentIndex == 1)
            {
               
              
                $("#overlay").fadeIn(300);

                   $.ajax({
                        url: base_url+'/csrf_token',
                        type: 'GET',
                        data: {},
                        dataType: 'json',
                        success: function (form_res) 
                        {
			 event.preventDefault();
                            token_res = form_res;
				var fd = new FormData();
                      
                             var justification_letter    = $('#justification_letter')[0].files;
                             var files                   = $('#nominator_photo')[0].files;

                            console.log('justification_letter',justification_letter);
			    console.log('justification_letter',files);	
                            // Append data 
                            if(justification_letter[0]) 
                                fd.append('justification_letter',justification_letter[0]);
                            else 
                                fd.append('justification_letter','');
                                
			    if(files[0])  
                                fd.append('nominator_photo',files[0]);
                            else 
                                fd.append('nominator_photo',''); 

                            var category                       = $("#category").val();
                            var nominee_name                   = $("#nominee_name").val();
                            var date_of_birth                  = $("#date_of_birth").val();
                            var citizenship                    = $("#citizenship").val();
                            var designation_and_office_address = $("#designation_and_office_address").val();
                            var residence_address              = $("#residence_address").val();
                            var mobile_no                      = $("#mobile_no").val();
                            var nominee_email                  = $("#nominee_email").val();
                            var nominator_name                 = $("#nominator_name").val();
                            var nominator_office_address       = $("#nominator_office_address").val();
                            var nominator_mobile               = $("#nominator_mobile").val();
                            var nominator_email                = $("#nominator_email").val();
                            var nominator_designation          = $("#nominator_designation").val();
                            var award_id                       = $("#award_id").val();
			    var minimumQualification           = $('input[name="minimum_qualification"]:checked').val(); 
				var cf = $('input[name="app_csrf').val();	
        		//console.log('csrf',cf);
                            fd.append('category',category);
                            fd.append('nominee_name',nominee_name);
                            fd.append('date_of_birth',date_of_birth);
                            fd.append('citizenship',citizenship);
                            fd.append('designation_and_office_address',designation_and_office_address);
                            fd.append('residence_address',residence_address);
                            fd.append('mobile_no',mobile_no);
                            fd.append('email',nominee_email);
                            fd.append('nominator_name',nominator_name);
                            fd.append('nominator_office_address',nominator_office_address);
                            fd.append('nominator_mobile',nominator_mobile);
                            fd.append('nominator_email',nominator_email);
                            fd.append('formType','fellowship');
                            fd.append('app_csrf',token_res.token);
                            fd.append('formTypeStatus','preview');
                            fd.append('award_id',award_id);
                            fd.append('nominator_designation',nominator_designation);
			    fd.append('minimum_qualification',minimumQualification);
                          //console.log('FormData',fd);
				//return false;
                                    $.ajax({
					  //  async: false,	
                                            url: base_url+'/fellowship/'+uri2,
                                            type: 'POST',
				            async: false,
                                            contentType: false,
                                            processData: false,
                                          //  dataType: 'json',
					    data: fd,
                                            cache:false,
					     timeout: 600000,		
                                            success: function (form_res) 
                                            { 
                                                $("#overlay").fadeOut(300);
                                                if(form_res.status && form_res.status == 'success'){
                                                    
                                                    if(form_res.message && form_res.message == 'preview')
                                                    $('#formPreview').html(form_res.html);
                                                }  
                                                else
                                                {
                                                    errorMessageAlert('Please check all form fields you have missed the fields to enter the value'); 
                                                    $("#formReplace").html(form_res.html);

                                                    setTimeout(function(){
                                                        triggerSteps();
                                                        },5000);
                                                    
                                                    return false;  
                                                }
                                            },
                                            error: function (jqXHR, textStatus, errorThrown)
                                            {
                                                $("#overlay").fadeOut(300);
                                                if(textStatus && textStatus == 'error'){
                                                   // if(jqXHR.responseJSON.message){
                                                    //    errorMessageAlert(jqXHR.responseJSON.message); 

                                                        setTimeout(function(){
                                                            triggerSteps();
                                                        },5000);
                                                    
                                                        return false;
                                                  //  }
                                                }
                                            }
                                        });

                                        
                                    }
                           });  

                           
                            
                            return form.valid();
                        
            }
            else
            {
                 return form.valid();     
            } 
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            if(!$("#acceptTerms").is(":checked")) {
                errorMessageAlert('Please accept terms & condition'); 
                return false;
            }
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            formSubmit();
        }

    });
    $('#date_of_birth').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#date_of_birth').datepicker("setDate", new Date());

    $("#date_of_birth").keyup(function(){
        
        var dt = $(this).val();

        $.ajax({
            url: base_url+'/ageCalculation/'+dt,
            type: 'GET',
            dataType: 'json',
            success: function (data) 
            {
                if(data.age)
                  $("#age").val(data.age);
            }
        });        
    })
});


function triggerSteps(csrf)
{

           var form = $("#formsection");

           form.validate();

           removeRules();

           form.children("div").steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                
                    event.preventDefault();
                    form.validate().settings.ignore = ":disabled,:hidden";
                
                    // Get the selected file
                    if(currentIndex && currentIndex == 1){
                        

                        token_res  = {};

                        $.ajax({
                            url: base_url+'/csrf_token',
                            type: 'GET',
                            data: {},
                            dataType: 'json',
                            success: function (form_res) 
                            {

                           
                                token_res = form_res;
                                
                                var justification_letter    = $('#justification_letter')[0].files;
                                var files                   = $('#nominator_photo')[0].files;

                                var fd = new FormData();
                                // Append data 
				
			     	if(files[0])  
                              	   fd.append('nominator_photo',files[0]);
                                else 
  	                           fd.append('nominator_photo',''); 
                                
                                if(justification_letter[0]) 
                                    fd.append('justification_letter',justification_letter[0]);
                                else 
                                    fd.append('justification_letter','');
                                    
                                var category                       = $("#category").val();
                                var nominee_name                   = $("#nominee_name").val();
                                var date_of_birth                  = $("#date_of_birth").val();
                                var citizenship                    = $("#citizenship").val();
                                var designation_and_office_address = $("#designation_and_office_address").val();
                                var residence_address              = $("#residence_address").val();
                                var mobile_no                      = $("#mobile_no").val();
                                var nominee_email                  = $("#nominee_email").val();
                                var nominator_name                 = $("#nominator_name").val();
                                var nominator_office_address       = $("#nominator_office_address").val();
                                var nominator_mobile               = $("#nominator_mobile").val();
                                var nominator_email                = $("#nominator_email").val();
                                var nominator_designation          = $("#nominator_designation").val();
				    var minimumQualification           = $('input[name="minimum_qualification"]:checked').val();

                                fd.append('category',category);
                                fd.append('nominee_name',nominee_name);
                                fd.append('date_of_birth',date_of_birth);
                                fd.append('citizenship',citizenship);
                                fd.append('designation_and_office_address',designation_and_office_address);
                                fd.append('residence_address',residence_address);
                                fd.append('mobile_no',mobile_no);
                                fd.append('email',nominee_email);
                                fd.append('nominator_name',nominator_name);
                                fd.append('nominator_office_address',nominator_office_address);
                                fd.append('nominator_mobile',nominator_mobile);
                                fd.append('nominator_email',nominator_email);
                                fd.append('formType','fellowship');
                                fd.append('nominator_designation',nominator_designation);
				fd.append('minimum_qualification',minimumQualification);

                               
                                fd.append('formTypeStatus','preview');
                                fd.append('app_csrf',token_res.token);
            
                                $.ajax({
                                    url: base_url+'/fellowship/'+uri2,
                                    type: 'POST',
                                    data: fd,
                                    contentType: false,
                                    processData: false,
                                    dataType: 'json',
                                    cache:false,
                                    success: function (form_res) 
                                    {
                                        $("#overlay").fadeOut(300);
                                        if(form_res.status && form_res.status == 'success'){
                                            if(form_res.message && form_res.message == 'preview')
                                            $('#formPreview').html(form_res.html);
                                        }  
                                        else
                                        {
                                            errorMessageAlert('Please check all form fields you have missed the fields to enter the value'); 
                                            $("#formReplace").html(form_res.html);
                                            setTimeout(function(){
                                                triggerSteps();
                                              },5000);
                                            return false;  
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        $("#overlay").fadeOut(300);
                                        if(textStatus && textStatus == 'error'){
                                            if(jqXHR.responseJSON.message){
                                                errorMessageAlert(jqXHR.responseJSON.message); 
                                                setTimeout(function(){
                                                    triggerSteps();
                                                  },5000);
                                                return false;
                                            }
                                        }
                                    }
                                });
                             }
                         });  
                        return form.valid();
                      
                    }
                    else
                    {
                        return form.valid();     
                    } 
                },
                onFinishing: function (event, currentIndex)
                {
                    form.validate().settings.ignore = ":disabled";
                    if(!$("#acceptTerms").is(":checked")) {
                        errorMessageAlert('Please accept terms & condition'); 
                        return false;
                    }
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    isEmailVerified = true;
                    formSubmit();
                }    
        });
    }

function successMessageAlert(msg)
{
    Msg.icon = Msg.ICONS.FONTAWESOME;
    Msg['success'](msg);
}

function errorMessageAlert(msg)
{
    Msg.icon = Msg.ICONS.FONTAWESOME;
    Msg['danger'](msg);
}


function additionalMethods()
{

    $.validator.addMethod('filesize', function (value, element,param) {
      
        var size=element.files[0].size;
        size=size/1024;
        size = Math.round(size);

       if(size <= 500 && $("#justification_letter"))
          return this.optional(element) || size <=param;
        else
           return false;  
    });

$.validator.addMethod('eligibleType', function (value, element,param) {
      
        if(value == 'MBBS')
          return this.optional(element) || value == param;
        else
           return false;  
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


function formSubmit()
{
    $("#overlay").fadeIn(300);

    token_res  = {};
    $.ajax({
        url: base_url+'/csrf_token',
        type: 'GET',
        data: {},
        dataType: 'json',
        success: function (form_res) 
        {
            token_res = form_res;
             
            var justification_letter    = $('#justification_letter')[0].files;
	     var files                   = $('#nominator_photo')[0].files;
	
    
            var fd = new FormData();
            // Append data 
            if(justification_letter[0]) 
                fd.append('justification_letter',justification_letter[0]);
            else 
                fd.append('justification_letter','');
	
	    if(files[0])  
               fd.append('nominator_photo',files[0]);
            else 
               fd.append('nominator_photo',''); 

                
            var category                       = $("#category").val();
            var nominee_name                   = $("#nominee_name").val();
            var date_of_birth                  = $("#date_of_birth").val();
            var citizenship                    = $("#citizenship").val();
            var designation_and_office_address = $("#designation_and_office_address").val();
            var residence_address              = $("#residence_address").val();
            var mobile_no                      = $("#mobile_no").val();
            var nominee_email                  = $("#nominee_email").val();
            var nominator_name                 = $("#nominator_name").val();
            var nominator_office_address       = $("#nominator_office_address").val();
            var nominator_mobile               = $("#nominator_mobile").val();
            var nominator_email                = $("#nominator_email").val();
            var nominator_designation          = $("#nominator_designation").val();
		    var minimumQualification           = $('input[name="minimum_qualification"]:checked').val();

            fd.append('category',category);
            fd.append('nominee_name',nominee_name);
            fd.append('date_of_birth',date_of_birth);
            fd.append('citizenship',citizenship);
            fd.append('designation_and_office_address',designation_and_office_address);
            fd.append('residence_address',residence_address);
            fd.append('mobile_no',mobile_no);
            fd.append('email',nominee_email);
            fd.append('nominator_name',nominator_name);
            fd.append('nominator_office_address',nominator_office_address);
            fd.append('nominator_mobile',nominator_mobile);
            fd.append('nominator_email',nominator_email);
            fd.append('formType','fellowship');
            fd.append('app_csrf',token_res.token);
            fd.append('formTypeStatus','submit');
            fd.append('nominator_designation',nominator_designation);
	    fd.append('minimum_qualification',minimumQualification);
	

            $.ajax({
                url: base_url+'/fellowship/'+uri2,
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                cache:false,
                success: function (form_res) 
                {
                    $("#overlay").fadeOut(300);
                    if(form_res.status && form_res.status == 'success'){
                        successMessageAlert('Thank you. Your application is under review , you should receive an email soon!');
                        setTimeout(function(){
                            window.location.href=base_url+'/success';
                        },5000);
                    }  
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $("#overlay").fadeOut(300);
                    if(textStatus && textStatus == 'error'){
                        if(jqXHR.responseJSON.message){
                            errorMessageAlert(jqXHR.responseJSON.message); 
                            return false;
                        }
                    }
                }
            });
        }
    });
}

function checkDuplicationEmail(isEmailVerified = true) {

    var emailStatus = '';
    if(!isEmailVerified) {
    $.validator.addMethod('checkDuplication',function(value,element,param){
        //var csrfHash = $("input[name='app_csrf']").val();
      //  return this.optional(element)
        token_res  = {};
        $.ajax({
            url: base_url+'/csrf_token',
            type: 'GET',
            data: {},
            dataType: 'json',
            success: function (form_res) 
            {
                token_res = form_res;  
                $.ajax({
                    url: base_url+'/nomination/check_unique_award_by_user',
                    type: 'POST',
                    data: {email:value,award_id:uri2,app_csrf:token_res.token},
                    dataType: 'JSON',
                    success: function(data) {
                        isEmailVerified = true;
                        $("#nominee_email").rules( "remove", "checkDuplication");
                        if(data.status && data.status == 'error'){
                            emailStatus = false;
                        }
                        else
                        {
                            console.log('data',data);
                            emailStatus = true;
                           $("#nominee_email").valid();
                           // return true; 
                        }
                        
                    },
                    error: function(data){
                        console.log('errors',data);
                    }
                });

               }
            });
         
        if(emailStatus !='') {
          if(emailStatus)
             return $("#formsection").valid();
        }   

        },'Please enter unique email!');  
    }   
}


function removeRules()
{
    var justificationFilename = $("#justification_letter_uploaded_file").val();
 
    if(justificationFilename!='' ){
      $("#justification_letter").rules("remove");
      $("#justification_letter").removeClass('required');
    }  

}

