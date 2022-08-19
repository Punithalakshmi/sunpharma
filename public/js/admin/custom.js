function nominee_approve(type = '',id='')
{
    var msg = (type && type == 'approve')?'approve':'disapprove';
    if(confirm("Are you sure you want to "+msg+" this Nominee?")){
        $.ajax({
            url : base_url+'/admin/nominee/approve',
            type: "POST",
            data : {type:type,id:id},
            dataType:'json',
            success: function(data, textStatus, jqXHR)
            {
                if(data.status && data.status == 'success')
                  alert(data.message);
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

    $.ajax({
        url : base_url+'/admin/nominee/assignJury',
        type: "POST",
        data : {nominee:array,juryID:juryID},
        dataType:'json',
        success: function(data, textStatus, jqXHR)
        {
            if(data.status && data.status == 'success')
              alert(data.message);

            $("#juryListsModal").hide();   
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            $("#juryListsModal").hide(); 
        }
    });

 }