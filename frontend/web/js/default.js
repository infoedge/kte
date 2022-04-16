$(function (){
         
    $('#dashboard-placement').change( function(){
        var pos = $('#dashboard-placement').find('input[type=radio]:checked').val();
        var baseurl = $('#dashboard-position').val();
        var lftend = $('#dashboard-lftside').val();
        var rgtend = $('#dashboard-rgtside').val();
        alert('BaseUrl: '+ baseurl + 'Leftend: '+ lftend + '; RightEnd: ' + rgtend + '; Pos: ' + pos);
        if( pos == 1){
            $('#dashboard-thelink').val(baseurl + lftend + pos);
        }else {
            $('#dashboard-thelink').val(baseurl + rgtend + pos);
        }
        
    });
    $('#linkcopy').click(function(){
        var copiedtxt=document.getElementById("dashboard-thelink");
        copiedtxt.select();
        copiedtxt.setSelectionRange(0,9999);
        document.execCommand("copy");
    });  
 });