  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>

    <?php include_once("inc/css-links.inc.php"); ?>
    <?php include_once("inc/js-links.inc.php"); ?>
    <link rel="stylesheet" href="inc/css/index.css">
    
  </head> 

  <body>
    <div class="container-fluid" style="height:100vh; width:100vw;">
      <div class="col d-flex align-items-center justify-content-center h-100">
        <div class="card card-body col-sm-6 col-md-5 col-lg-4 col-xl-3">
          <h2 class="h2"><center>LOGIN</center></h2>
          <div class="form-group mt-4">
						<label class="label">USERNAME</label>
            <input class="form-control" type="text" name="" id="username" placeholder="Username"></div>
          <div class="form-group mt-2">
						<label class="label">PASSWORD</label>
            <input class="form-control" type="password" name="" id="password" placeholder="Password">
          </div>
          <div class="form-group mt-2">
            <button class="btn btn-primary w-100 p-2" id="login">Login</button>
          </div>
					<div class="form-group d-flex align-items-center justify-content-center">
						<span style="margin-right:5px;" class="span">Don't have an account?</span>
						<a href="register.php">Register</a>
					</div>
        </div>
      </div>
    </div>
  </body>


  <script defer type="text/javascript">
    window.addEventListener("load", () => {

      // add a eventListener to the submitBtn
      const loginBtn = document.getElementById("login");
      loginBtn.addEventListener("click", e => {

        $.ajax({
          url : "ajax/index.ajax.php",
          type : "POST",
          data : {
            username : document.getElementById("username").value,
            password : document.getElementById("password").value
          },
          success : function(resp){
            resp = JSON.parse(resp);
            if (resp.status == "success") window.open(`${resp.link}`, "_self"); // redirect to the user's logging page (if user is logged correctly)
            if (resp.status == "error") alert(resp.msg);
          }
        });
      })
    })
  </script>
  </html>
