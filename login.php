<?php 
    session_start();
    
    ?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" href="login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
            <?php
            #---------------registeronsubmit="return prova()"
                $db_con = new mysqli('xxx.xxx.xxx.xxx', 'xxxxxxx', 'xxxxxxx', 'xxxxxx');
                
                    if($ncheck && $ccheck && $mcheck && $pcheck){
                        
                        $insert="INSERT INTO utente (id_utente, nome, cognome, mail, ruolo, pw, foto) VALUES (NULL, '".$_POST['nome']."', '".$_POST['cognome']."', '".$_POST['mail']."', '".$ruolo."','".$_POST['password']."','avatar.png')";
                        mysqli_query($db_con,$insert);
                        $sql = "SELECT id_utente FROM utente WHERE mail LIKE '".$_POST['mail']."'";
                        $execute = mysqli_query($db_con, $sql);
                        $row = mysqli_fetch_assoc($execute);
                        $_SESSION['id_utente']=$row;
                        header("LOCATION: index.php");
                    }
                 #--------------login
                if(isset($_POST['email'])){
                    $sql = "SELECT COUNT(*) as total FROM utente WHERE mail LIKE '".$_POST['email']."'";
                    $execute = mysqli_query($db_con, $sql);
                    $row = mysqli_fetch_assoc($execute);
                    
                    if($row['total']!=0){
                        $sql = "SELECT conferma FROM utente WHERE mail LIKE '".$_POST['email']."'";
                        $execute = mysqli_query($db_con, $sql);
                        $row=mysqli_fetch_assoc($execute);
                        if($row['conferma']=="conf")
                        {
                            $sql = "SELECT COUNT(*) as total FROM utente WHERE pw LIKE '".$_POST['password']."' AND mail LIKE '".$_POST['email']."'";
                            $execute = mysqli_query($db_con, $sql);
                            $row = mysqli_fetch_assoc($execute);
                            if($row['total']!=0){
                                $sql = "SELECT id_utente FROM utente WHERE mail LIKE '".$_POST['email']."'";
                                $execute = mysqli_query($db_con, $sql);
                                $row = mysqli_fetch_assoc($execute);
                                $_SESSION['id_utente']=$row;
                                header("LOCATION: index.php");
                            }
                            else{
                                pw_not_found();
                            }
                        }
                        else
                        {
                            mail_not_exist();
                        }
                    }
                    else
                    {
                        mail_not_found();
                    }
                }
                
                
            ?>
</head>
<body>
    <?php 
    if(isset($_GET['invio_mail']))
    {
        mail_inviata();
    }
    if(isset($_GET['mp']))
    {
        mail_presente();
    }
    function mail_presente(){
        echo"<script>alert('mail già utilizzata, prova a fare il login o usa un altro indirizzo email');</script>";
    }
    function alert(){
        echo"<script>alert('mail già utilizzata, prova a fare il login o usa un altro indirizzo email');</script>";
    }
    function mail_inviata(){
        echo "<script>alert('controlla la tua casella postale per confermare la mail, se non ti arriva entro una decina di minuti contattaci')</script>";
    }
    function mail_not_found(){
        echo"<script>alert('mail non trovata, prova a registrarti oppure contattaci')</script>";
    }
    function pw_not_found(){
        echo"<script>alert('password errata, se non la ricordi contattaci')</script>";
    }
    function mail_not_exist(){
        echo"<script>alert('la mail non è stata confermata, controlla la tua casella postale')</script>";
    }
    ?>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup" >
				<form method="post" action="invio.php" onsubmit="return prova()">
					<label for="chk"  aria-hidden="true">Sign up</label>
                    <input type="email" name="mail" placeholder="email" id="mail" required="">
					<input type="text" name="nome" placeholder="nome" required="">
                    <input type="text" name="cognome" placeholder="cognome" required="">
					<input type="password" id="password" name="password" placeholder="Password" required="">
                    <input type="button" value="RICONTROLLA" id="richeck" class="btn" style="display:none" >
                    <input type="submit" value="REGISTRATI" id="submit_check" class="btn" ><br>
				</form>
			</div>

			<div class="login">
				<form method="post" action="login.php">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
                    <input type="submit" value="LOGIN" id="submit" name="login" class="btn"><br>
				</form>
			</div>
	</div>
    <script>
        controllo=false;
        function prova(){
            mail = document.getElementById("mail").value;
            dominio = mail.split("@");
                if(dominio[1]!="sabin.istruzioneer.it")
                    {
                        alert("il dominio della mail deve essere @sabin.istruzioneer.it")
                        return false
                    }
                    else{
                        
                        return true
                    }
        }     
    </script>
</body>
</html>