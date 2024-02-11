<?php

error_reporting(E_ALL);
$db_con = new mysqli('31.11.39.103', 'Sql1665083', 'Albert@220404', 'Sql1665083_1');
$sql = "SELECT COUNT(*) as total FROM utente WHERE mail LIKE '".$_POST['mail']."'";
$execute = mysqli_query($db_con, $sql);
$row = mysqli_fetch_assoc($execute);
if($row['total']!=0){
    header("LOCATION: login.php?mp=1");
    exit;
}
$ruolo="studente";
$insert="INSERT INTO utente (id_utente, nome, cognome, mail, ruolo, pw, foto) VALUES (NULL, '".$_POST['nome']."', '".$_POST['cognome']."', '".$_POST['mail']."', '".$ruolo."','".$_POST['password']."','avatar.png')";
mysqli_query($db_con,$insert);
// Genera un boundary
$mail_boundary = "=_NextPart_" . md5(uniqid(time()));

$to = $_POST['mail'];
$subject = "conferma credenziali";
$sender = 'postmaster@jonasmicocci.com';


$headers = "From: $sender\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: multipart/alternative;\n\tboundary=\"$mail_boundary\"\n";
$headers .= "X-Mailer: PHP " . phpversion();
 
// Corpi del messaggio nei due formati testo e HTML
$text_msg = "messaggio in formato testo";
$html_msg = "<b>messaggio</b> in formato <p><a href='http://www.aruba.it'>html</a><br><img src=\"http://hosting.aruba.it/image_top/top_01.gif\" border=\"0\"></p>";
 
// Costruisci il corpo del messaggio da inviare
$msg = "This is a multi-part message in MIME format.\n\n";
$msg .= "--$mail_boundary\n";
$msg .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
$msg .= "Content-Transfer-Encoding: 8bit\n\n";
$msg .= "";  // aggiungi il messaggio in formato text

$link="www.jonasmicocci.com/appunti/conferma.php?mail=".$_POST['mail'];
$msg .= "\n--$mail_boundary\n";
$msg .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
$msg .= "Content-Transfer-Encoding: 8bit\n\n";
$msg .= "ciao ".$_POST['nome']."!! sei a un passo da poter accedere a tutti i servizi di NoteHub. clicca il link qua per confermare la tua mail ".$link;  // aggiungi il messaggio in formato HTML
 
// Boundary di terminazione multipart/alternative
$msg .= "\n--$mail_boundary--\n";
 
// Imposta il Return-Path (funziona solo su hosting Windows)
ini_set("sendmail_from", $sender);
 
// Invia il messaggio, il quinto parametro "-f$sender" imposta il Return-Path su hosting Linux
if (mail($to, $subject, $msg, $headers, "-f$sender")) { 
    header("LOCATION: login.php?invio_mail=1");
} else { 
    echo "<br><br>Recapito e-Mail fallito!";
}

?>