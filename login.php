<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css">

</head>
<body>


<div class="wrapper fadeInDown">
  <div id="formContent">

    <div class="fadeIn first">
      <img src="assets/img/logo.jpg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
      <input type="text"  class="fadeIn second"  id="name" placeholder="Name" required>
      <input type="text"  class="fadeIn third"  id="password"  placeholder="password" maxlength="8" required>
      <input type="submit" class="fadeIn fourth btnLogin" value="Log In">

  

  </div>
</div>
</body>
<script>
    $(".btnLogin").on("click", function(){
        
         var name = $("#name").val();
         var password = $("#password").val();
if(jQuery.isEmptyObject(name) || jQuery.isEmptyObject(password)){

            alert("All fields are mandatory!");
}else{
         $.ajax({
            url : 'login-function.php',
            type : 'POST',
            data : {name:name,password:password, action: "login"},
            dataType : 'html',
            success: function(response, textStatus, jqXHR) { 
                const res = JSON.parse(response);
              
              if(res.Error == true){
                alert(res.message);
              }else {if(res.message == "1"){
                    window.location.href='doctor.php';//doctor
                }else{
                    if(res.message == "2"){window.location.href='patient.php';}//patient
                    else{
                        if(res.message == "3"){window.location.href='lab.php';}//lab
                        else{
                        window.location.href='dashboard.php';//admin

                        }
                    }
                    

                }



              }
            }
         });

        }
       
      });
</script>
</html>
