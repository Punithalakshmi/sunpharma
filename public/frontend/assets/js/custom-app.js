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

function testFormSubmit()
{

	$.ajax({
                        url: base_url+'/csrf_token',
                        type: 'GET',
                        data: {},
                        dataType: 'json',
                        success: function (form_res) 
                        {
                            token_res = form_res;

					var justification_letter    = $('#firstname')[0].files;
							var fd = new FormData();

                      	    if(justification_letter[0]) 
                                fd.append('justification_letter',justification_letter[0]);
                            else 
                                fd.append('justification_letter','');

				fd.append('app_csrf',token_res.token);																																																																																																																																																																																																																																																																																																																																																																																																																																										

                                    $.ajax({
                                            url: base_url+'/testform',
                                            type: 'POST',
                                           // data: {'app_csrf':token_res.token,'firstname':'test'},
					    data: fd,
					    contentType:false,
					    processType:false,
					    cache: false,		
                                            dataType: 'json',
						enctype: 'multipart/form-data',
                                            success: function (form_res) 
                                            { 

                                                if(form_res.status && form_res.status == 'success'){
                                                    
                                                  }  
                                                else
                                                {
                                                  return false;  
                                                }
                                            },
                                            error: function (jqXHR, textStatus, errorThrown)
                                            {
                                               return false;
                                               
                                            }
                                        });

                                        
                                    }
                           });  


}