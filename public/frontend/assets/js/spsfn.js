
const progress = (value) => {
    document.getElementsByClassName('progress-bar')[0].style.width = `${value}%`;
 }
 
 $(document).ready(function(){
  var form = $("#science_scholar_awards");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        // nominator_photo: {
        //     extension: "jpg|jpeg|png",
        //     filesize: 5
        // }
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
        var files                   = $('#nominator_photo')[0].files;
        var justification_letter    = $('#justification_letter')[0].files;
        var supervisor_certifying                = $('#supervisor_certifying')[0].files;
        
        var fd = new FormData();
        // Append data 
        fd.append('nominator_photo',files[0]);
        fd.append('justification_letter',justification_letter[0]);
        fd.append('supervisor_certifying',supervisor_certifying[0]);
        
        if(currentIndex && currentIndex == 1){
            $("#overlay").fadeIn(300);
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
       
        $.ajax({
                url: base_url+'/spsfn',
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
        alert('Your Application Submitted Successfully.');

    }

  });
 });