<?php 

if(isset($_POST['aggiorna']))
{
    echo"funzione avviata";
}
else{
    echo"funzione sbagliata";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup" >
				<form method="get">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="nome" placeholder="nome" required="">
                    <input type="text" name="cognome" placeholder="cognome" required="">
					<input type="email" name="mail" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<input type="submit" value="REGISTRATI" id="submit" class="btn" ><br>
				</form>
			</div>

			<div class="login">
				<form>
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="mail" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
                    <input type="submit" value="LOGIN" id="submit" name="login" class="btn"><br>
				</form>
			</div>
	</div>
</body>
</html>