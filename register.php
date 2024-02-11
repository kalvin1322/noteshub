<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register - appunti</title>
    <script>
        function start(){
            <?php
                $db_con = new mysqli('xxxxxxxx','xxxxxx', 'xxxxxx', 'xxxxxx');
                $ncheck=false;
                $ccheck=false;
                $mcheck=false;
                $pcheck=false;
                $ruolo = 'studente';
                if(isset($_GET['nome'])){
                    $ncheck = true;
                }
                if(isset($_GET['cognome'])){
                    $ccheck = true;
                }
                if(isset($_GET['mail'])){
                    #controllo sulla mail (ricerca sull'MSTP)
                    $mcheck = true;
                }
                if(isset($_GET['password'])){
                    #controllo sulla password(5 caratteri, maiuscole, minuscoli, numeri)
                    $pcheck = true;
                }
                if($ncheck && $ccheck && $mcheck && $pcheck){
                    $insert="INSERT INTO utente (id_utente, nome, cognome, mail, ruolo, pw) VALUES (NULL, '".$_GET['nome']."', '".$_GET['cognome']."', '".$_GET['mail']."', '".$ruolo."','".$_GET['password']."')";
                    mysqli_query($db_con,$insert);
                    header("LOCATION: login.php?mail=".$_GET['mail']);
                }
            ?>
        }

    </script>
</head>
<body onload='start()'>
    <div class="corpo">
        <div class="container">
            <form action="register.php" method="get">
                <h1>Register</h1>
                <div id='nome_check'>
                    <input type="text" name="nome" placeholder="nome">
                </div>
                <div id='cognome_check'>
                    <input type="text" name="cognome" placeholder="cognome">
                </div>
                <div id='mail_check'>
                    <input type="text" name="mail" placeholder="mail">
                </div>
                <div id='password_check'>
                    <input type="password" name="password" placeholder="password">
                </div>
                
                <a href="login.php">SEI GIA' REGISTRATO? ACCEDI</a><br>
                <a href="index.php">ENTRA SENZA REGISTRARTI</a>
            </form>
        </div>
    </div>
</body>
</html>