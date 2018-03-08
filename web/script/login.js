$(document).ready(function(){
 $("#add_err").css('display', 'none', 'important');
 $("#login-btn").click(function(){
   email=$("#email").val();
   password=$("#password").val();
   $.ajax({
    type: "POST",
    url: "script/singin.script.php",
 data: "email="+email+"&password="+password,
    success: function(html){
 if(html=='true')    {
 //$("#add_err").html("right username or password");
 window.location="index.php";
 }
 else    {
 $("#add_err").css('display', 'inline', 'important');
 $("#add_err").html("<img src='images/alert.png' />Wrong username or password");
 }
    },
    beforeSend:function()
    {
 $("#add_err").css('display', 'inline', 'important');
 $("#add_err").html("<img src='images/ajax-loader.gif' /> Loading...")
    }
   });
 return false;
 });
});
