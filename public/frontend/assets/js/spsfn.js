
const progress = (value) => {
    document.getElementsByClassName('progress-bar')[0].style.width = `${value}%`;
 }
 
 $(document).ready(function(){

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
    
    $.validator.addMethod(
        "validDOB",
        function(value, element) {              
        
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
            }
            else
            {
                return false;
            }
        }
    );


var form = $("#science_scholar_awards");
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
       
        $.ajax({
                url: base_url+'/getPostedData',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                cache:false,
                success: function (form_res) 
                {
                    jQuery('#formPreview').html(form_res.html);
                    setTimeout(function(){
                        $("#overlay").fadeOut(300);
                      },500);
                }
            });
        }
    
        return form.valid();
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

  });
 });