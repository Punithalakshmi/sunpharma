
const progress = (value) => {
    document.getElementsByClassName('progress-bar')[0].style.width = `${value}%`;
 }
 
 

 function ongoingCourse(e){
    var courseVal = $(e).val();

    if( courseVal == 'other'){
        $("#courseName").show();
    }
    else
    {
        $("#courseName").hide();
    }

 }

 $(document).ready(function(){
     
      var form = $("#science_scholar_awards");
      var isEmailVerified = false;
      
      additionalMethods()

      


form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        nominator_photo: {
            extension: "jpg,png,jpeg",
            filesize: 500
        },
        date_of_birth:{
           validDOB:30
        },
        supervisor_certifying:{
           extension: "pdf",
           filesize: 500
        },
        justification_letter:{
           extension: "pdf",
           filesize: 500
        },
        mobile_no:{
            minlength:10,
            maxlength:10
         },
         nominator_mobile:{
            minlength:10,
            maxlength:10
         },
         research_project:{
            eligibleType:'Yes'
         }
    },
    messages: {
        nominator_photo:{
            filesize:" Nominator Photo size not more than 500KB."
        },
        date_of_birth:{
            validDOB: 'Age should be less than 30 years.'
        },
        supervisor_certifying:{
            filesize:"File size not more than 500KB"
        },
        justification_letter:{
            filesize:"File size not more than 500KB"
        },
        research_project:{
            eligibleType: "Your are not eligible to register, you should be completed project"
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
       
        if(currentIndex && currentIndex == 1){

            $("#overlay").fadeIn(300);

            $.ajax({
                url: base_url+'/csrf_token',
                type: 'GET',
                data: {},
                dataType: 'json',
                success: function (form_res) 
                {
                    token_res = form_res;
        
                    //var csrfHash = $("input[name='app_csrf']").val(); 
                    // Get the selected file
                    var files                   = $('#nominator_photo')[0].files;
                    var justification_letter    = $('#justification_letter')[0].files;
                    var supervisor_certifying   = $('#supervisor_certifying')[0].files;
                    
                    var fd = new FormData();
                    // Append data 
                    fd.append('nominator_photo',files[0]);
                    fd.append('justification_letter',justification_letter[0]);
                    fd.append('supervisor_certifying',supervisor_certifying[0]);

                    var category      = $("#category").val();
                    var nominee_name  = $("#nominee_name").val();
                    var date_of_birth = $("#date_of_birth").val();
                    var citizenship   = $("#citizenship").val();
                    var designation_and_office_address = $("#designation_and_office_address").val();
                    var residence_address = $("#residence_address").val();
                    var mobile_no         = $("#mobile_no").val();
                    var nominee_email     = $("#nominee_email").val();
                    var nominator_name    = $("#nominator_name").val();
                    var nominator_office_address = $("#nominator_office_address").val();
                    var nominator_mobile     = $("#nominator_mobile").val();
                    var nominator_email      = $("#nominator_email").val();
                    var ongoing_course       = $("#ongoing_course").val();
                    var research_project     = $("#research_project").val();

                
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
                    fd.append('ongoing_course',ongoing_course);
                    fd.append('research_project',research_project);
                    fd.append('formType','spsfn');
                    fd.append('app_csrf',token_res.token);
                    fd.append('formTypeStatus','preview');
       
                    $.ajax({
                        url: base_url+'/spsfn/'+uri2,
                        type: 'post',
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
            $("#acceptTerms").addClass('required');
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

 });


function triggerSteps()
{

var form = $("#science_scholar_awards");
// form.validate({
//     errorPlacement: function errorPlacement(error, element) { element.before(error); },
//     rules: {
//         nominator_photo: {
//             extension: "jpg,png,jpeg",
//             filesize: 500
//         },
//         date_of_birth:{
//            validDOB:30
//         },
//         supervisor_certifying:{
//            extension: "pdf",
//            filesize: 500
//         },
//         justification_letter:{
//            extension: "pdf",
//            filesize: 500
//         },
//         mobile_no:{
//             minlength:10,
//             maxlength:10
//          },
//          nominator_mobile:{
//             minlength:10,
//             maxlength:10
//          }
//     },
//     messages: {
//         nominator_photo:{
//             filesize:" Nominator Photo size not more than 500KB."
//         },
//         date_of_birth:{
//             validDOB: 'Age should be less than 30 years.'
//         },
//         supervisor_certifying:{
//             filesize:"File size not more than 500KB"
//         },
//         justification_letter:{
//             filesize:"File size not more than 500KB"
//         }
        
//       }
// });
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
       
        if(currentIndex && currentIndex == 1){

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
                        // Get the selected file
                        var files                   = $('#nominator_photo')[0].files;
                        var justification_letter    = $('#justification_letter')[0].files;
                        var supervisor_certifying   = $('#supervisor_certifying')[0].files;
                        
                        var fd = new FormData();
                        // Append data 
                        fd.append('nominator_photo',files[0]);
                        fd.append('justification_letter',justification_letter[0]);
                        fd.append('supervisor_certifying',supervisor_certifying[0]);

                        var category = $("#category").val();
                        var nominee_name = $("#nominee_name").val();
                        var date_of_birth = $("#date_of_birth").val();
                        var citizenship = $("#citizenship").val();
                        var designation_and_office_address = $("#designation_and_office_address").val();
                        var residence_address = $("#residence_address").val();
                        var mobile_no = $("#mobile_no").val();
                        var nominee_email = $("#nominee_email").val();
                        var nominator_name = $("#nominator_name").val();
                        var nominator_office_address = $("#nominator_office_address").val();
                        var nominator_mobile = $("#nominator_mobile").val();
                        var nominator_email = $("#nominator_email").val();
                        var ongoing_course  = $("#ongoing_course").val();
                        var research_project  = $("#research_project").val();

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
                        fd.append('ongoing_course',ongoing_course);
                        fd.append('research_project',research_project);
                        fd.append('formType','spsfn');
                        fd.append('app_csrf',token_res.token);
                        fd.append('formTypeStatus','preview');
                    
                            $.ajax({
                                        url: base_url+'/spsfn/'+uri2,
                                        type: 'post',
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
            formSubmit();
        }
    });
}


function additionalMethods()
{
    $.validator.addMethod('filesize', function (value, element,param) {
      
        var size=element.files[0].size;
        size=size/1024;
        size = Math.round(size);

        if(size <= 500 && $("#nominato_photo"))
          return this.optional(element) || size <=param;
        else if(size <= 500 && $("#justification_letter"))
          return this.optional(element) || size <=param;
        else
           return false;  

    });    
    
    $.validator.addMethod('eligibleType', function (value, element,param) {
      
        if(value == 'Yes')
          return this.optional(element) || value == param;
        else
           return false;  
    }); 
    
    $.validator.addMethod(
        "validDOB",
        function(value, element) {              
        
             console.log('valueDate',value);
            var dob = new Date(value);
            var today = new Date('08/01/2022');
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
           
            console.log('valueDate',age);
            if (age <= 30){
                return true;
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
    
}

function errorMessageAlert(msg)
{
    Msg.icon = Msg.ICONS.FONTAWESOME;
    Msg['danger'](msg);
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
             
            var files                   = $('#nominator_photo')[0].files;
            var justification_letter    = $('#justification_letter')[0].files;
            var supervisor_certifying   = $('#supervisor_certifying')[0].files;
            
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

            if(supervisor_certifying[0])  
                fd.append('supervisor_certifying',supervisor_certifying[0]);
            else  
                fd.append('supervisor_certifying','');

            
            var fd = new FormData();
            // Append data 
            fd.append('nominator_photo',files[0]);
            fd.append('justification_letter',justification_letter[0]);
            fd.append('supervisor_certifying',supervisor_certifying[0]);
   
           var category      = $("#category").val();
           var nominee_name  = $("#nominee_name").val();
           var date_of_birth = $("#date_of_birth").val();
           var citizenship   = $("#citizenship").val();
           var designation_and_office_address = $("#designation_and_office_address").val();
           var residence_address = $("#residence_address").val();
           var mobile_no         = $("#mobile_no").val();
           var nominee_email     = $("#nominee_email").val();
           var nominator_name    = $("#nominator_name").val();
           var nominator_office_address = $("#nominator_office_address").val();
           var nominator_mobile     = $("#nominator_mobile").val();
           var nominator_email      = $("#nominator_email").val();
           var ongoing_course       = $("#ongoing_course").val();
           var research_project     = $("#research_project").val();
   
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
           fd.append('ongoing_course',ongoing_course);
           fd.append('research_project',research_project);
           fd.append('formType','spsfn');
           fd.append('app_csrf',token_res.token);
           fd.append('formTypeStatus','submit');

            $.ajax({
                url: base_url+'/spsfn/'+uri2,
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

function checkDuplicationEmail(isEmailVerified){

    var emailStatus = '';
    if(!isEmailVerified) {
    $.validator.addMethod('checkDuplication',function(value,element,param){
       
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
                        if(data.status && data.status == 'error'){
                            
                            emailStatus = false;
                        }
                        else
                        {
                            
                            emailStatus = true; 
                        }
                        
                    },
                    error: function(data){
                        var errors = $.parseJSON(data.responseText).errors;
                        if (errors.email) {
                            validator.showErrors({
                                "email": errors.email[0]
                            });
                        }
                    }
                });

               }
            });
         
        if(emailStatus !='')
          return emailStatus;  

        });  
    }   
}