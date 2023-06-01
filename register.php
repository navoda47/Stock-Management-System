<?php 
	require_once("./database/dbase.php");
?>
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
	<div class="container-fluid" style="height:100vh !important; width:100vw;">
		<div class="d-flex align-items-center justify-content-center h-100">
			<div class="col-10 col-sm-6 col-md-5 col-lg-3">
				<div class="card card-body">
					<h2 class="h2">
						<center>USER REGISTER</center>
					</h2>
					<div class="form-group mt-5">
						<label class="label">USERNAME</label>
						<input id="username" type="text" class="form-control" />
					</div>
					<div class="form-group">
						<label class="label">DESIGNATION</label>
						<select id="designation" class="form-control form-select">
							<option hidden disabled selected value="">Designation</option>
							<?php
							$sql = "select * from u_desi_name";
							$records = $conn->query($sql)->fetchAll();
							foreach ($records as $record) {
								echo "<option value='$record[u_desi_index]'>$record[udesi]</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label class="label">BRANCH</label>
						<select id="usecid" class="form-control form-select">
							<option hidden disabled selected value="">Branch</option>
							<?php
							$sql = "select * from user_section";
							$records = $conn->query($sql)->fetchAll();
							foreach ($records as $record) {
								echo "<option value='$record[usection_id]'>$record[usection]</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group ">
						<label class="label">TELEPHONE NO</label>
						<input id="teleno" type="text" class="form-control" onkeypress="return onlyNumberKey(event)" maxlength="10"/>
					</div>
					<div class="form-group mt-3">
						<button id="register-btn" class="d-flex align-items-center justify-content-center form-control btn btn-primary p-4">Register</button>
					</div>
					<div class="form-group d-flex align-items-center justify-content-center">
						<span style="margin-right:5px;">Already have an Account?</span>
						<a href="index.php">Login</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script defer type="text/javascript">
	window.addEventListener("load", () => {

		const registerBtn = document.getElementById("register-btn");
		registerBtn.addEventListener("click", e => {
			if(window.confirm("Do you want to register?"))
			{
				$.ajax({
					url : "ajax/register.ajax.php",
					type : "POST",
					data : {
						username : document.getElementById("username").value,
						designation : document.getElementById("designation").value,
						usecid : document.getElementById("usecid").value,
						teleno: document.getElementById("teleno").value
					},
					success : function(resp){
						$("#username").val("");
						$("#designation").val("");
						$("#usecid").val("");
						$("#teleno").val("");
					
						resp = JSON.parse(resp);
						if (resp.status == "error" || resp.status == "success") alert(resp.msg);
						if (resp.status == "success") window.location.reload();
					}
				});
			}
		})
	})

	function onlyNumberKey(evt) {
              
		// Only ASCII character in that range allowed
		var ASCIICode = (evt.which) ? evt.which : evt.keyCode
		if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
			return false;
		return true;
	}
</script>

</body>
</html>