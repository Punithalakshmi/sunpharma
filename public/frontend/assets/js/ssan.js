
    const progress = (value) => {
        document.getElementsByClassName('progress-bar')[0].style.width = `${value}%`;
    }
 
$(document).ready(function(){   

//Size in kb
    $.validator.addMethod('filesize', function (value, element,param) {
      
        var size=element.files[0].size;
        size=size/1024;
        size = Math.round(size);

        if(size <= 500 && $("#nominato_photo"))
          return this.optional(element) || size <=param;
        else if(size <= 500 && $("#justification_letter"))
          return this.optional(element) || size <=param;
        else if(size <= 500 && $("#passport"))
          return this.optional(element) || size <=param;
        else
           return false;  

    });    
    
    $.validator.addMethod(
        "validDOB",
        function(value, element) {              
          //  var from = value.split(" "); // DD MM YYYY
          //   var value = '01/08/2022';
             var from = value.split("-"); // DD/MM/YYYY
            var day = from[2];
            var month = from[1];
            var year = from[0];
            var age = 30;

            var mydate = new Date();
            mydate.setFullYear(year, month-1, day);

            var currdate = new Date();
            currdate.setFullYear('2022','08','01');
            
            var setDate = new Date();

            setDate.setFullYear(mydate.getFullYear() + age, month-1, day);

            if ((currdate - setDate) > 0){
                return true;
            }else{
                return false;
            }
        }
    );

var form = $("#formsection");
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
         justification_letter:{
            extension: "pdf",
            filesize: 500
         },
         passport:{
            required: {
                depends: function(elem) {
                             if($("#citizenship").val() == 2)
                                return true;
                    }
            },
            extension: "pdf"
         },
         mobile_no:{
            minlength:10,
            maxlength:10
         },
         nominator_mobile:{
            minlength:10,
            maxlength:10
         }
    },
    messages: {
        nominator_photo:{
            filesize:" Nominator Photo should be size 500KB."
        },
        date_of_birth:{
            validDOB: 'Age should be less than 30 years.'
        },
        justification_letter:{
            filesize:"Justification Letter file size should be 500KB"
        },
        passport: {
            filesize: "Passport file size should be 500KB"
        }
      } 
    });
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
       
        console.log('currentIndex',currentIndex);
        event.preventDefault();
        form.validate().settings.ignore = ":disabled,:hidden";
       
        // Get the selected file
        if(currentIndex && currentIndex == 1){

               $("#overlay").fadeIn(300);

               var csrfHash = $("input[name='app_csrf']").val(); // CSRF hash  

                console.log('csrfName',csrfHash);
        
                var files                   = $('#nominator_photo')[0].files;
                var justification_letter    = $('#justification_letter')[0].files;
                var passport                = $('#passport')[0].files;
                
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

                if(passport[0])  
                    fd.append('passport',passport[0]);
                else  
                    fd.append('passport','');
                    
                var category      = $("#category").val();
                var nominee_name  = $("#nominee_name").val();
                var date_of_birth = $("#date_of_birth").val();
                var citizenship   = $("#citizenship").val();
                var designation_and_office_address = $("#designation_and_office_address").val();
                var residence_address = $("#residence_address").val();
                var mobile_no = $("#mobile_no").val();
                var nominee_email = $("#nominee_email").val();
                var nominator_name = $("#nominator_name").val();
                var nominator_office_address = $("#nominator_office_address").val();
                var nominator_mobile = $("#nominator_mobile").val();
                var nominator_email = $("#nominator_email").val();
            
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
                fd.append('formType','ssan');
                fd.append('app_csrf',csrfHash);

                $.ajax({
                        url: base_url+'/ssan',
                        type: 'POST',
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        cache:false,
                        success: function (form_res) 
                        {
                            jQuery('#formPreview').html(form_res.html);
                            if(form_res.status && form_res.status == 'success'){
                             //   $("a[href$='next']").show();
                            //    $("a[href$='previous']").show();
                             //   return form.valid();
                            }  
                            else
                            {
                                $("a[href$='next']").hide();
                                $("a[href$='previous']").show(); 
                                return false;  
                            }
                            

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            if(textStatus && textStatus == 'error'){
                                if(jqXHR.responseJSON.message){
                                    errorMessageAlert(jqXHR.responseJSON.message); 
                                    return false;
                                }
                            }
                        }
                    });
        }
        else
        {
            return form.valid();
        }
    
        
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        form.submit();
        alert('Thank you. Your application is under review , you should receive an email soon!');
    }

  })
 
});


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