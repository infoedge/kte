$(function (){
         
    $('#addPerson').click( function(){
        $(this).attr("src","images/common/plussign-pushed.png");
         $.get('index.php?r=genealogy/sponsorship/add-person');
         //alert('Clicked AddPerson Button');
    });
    
    
 });


