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
       if(html=="true") {
       $("#add_err").html("Přihlašuji");
       setTimeout(' window.location.reload(); ',2000);
       }
       else    {
       $("#add_err").css('display', 'inline', 'important');
       $("#add_err").html("Špatné uživatelské jméno nebo heslo");
       }
    },
    beforeSend:function()
 {
    $("#add_err").css('display', 'inline', 'important');
    $("#add_err").html(" Načítám...")
 }
   });
 return false;
 });


 $("#register-btn").click(function(){
   $.ajax({
    type: "POST",
    url: "script/register.script.php",
    data: $('#registerForm').serialize(),
    dataType: 'json',
    async: false,
    success: function(d){
       if(d.stav == "true") {
       $("#add_err_reg").html("Registrace proběhla úspěšně, registruji");
       setTimeout(' window.location.reload(); ',1000);
       }
       else{
         $("#add_err_reg").css('display', 'inline', 'important');
         $("#add_err_reg").html(d.stav);
       }

    },
    beforeSend:function()
 {
    $("#add_err_reg").css('display', 'inline', 'important');
    $("#add_err_reg").html(" Načítám...")
 }
   });
 return false;
 });

});//document ready
