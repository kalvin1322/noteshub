<?php
    $host="31.11.39.103";
    $conn = mysqli_connect($host, 'Sql1665083', 'Albert@220404', 'Sql1665083_1');
    $mail=$_GET['mail'];
    $insert="UPDATE utente SET conferma='conf' WHERE mail='".$mail."'";
    mysqli_query($conn,$insert);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="width:100vw; margin-top:10vh"><h2 style="text-align:center;">LA TUA MAIL è STATA CONFERMATA</h2>
    <a href="login.php">clicca qui per fare il login</a>
    </div>
</body>
</html>