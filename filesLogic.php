<?php
// connesione db
$host="xxx.xxx.xxx.xxx";
$conn = mysqli_connect($host, 'xxxxxxx', 'xxxxxx', 'xxxxxx');
$sql = "SELECT * FROM `file`";
$result = mysqli_query($conn, $sql);
$files=mysqli_fetch_all($result, MYSQLI_ASSOC);
// codice per l'upload del file
if(isset($_POST['cuore_piu']))
{
$cuore=$_POST['cuore_piu'];
$utente=$_POST['utente'];
$insert="INSERT INTO `salvati` (id_utente,id_file) VALUES ('$utente','$cuore')";
$result=mysqli_query($conn,$insert);
}
if(isset($_POST['cuore_meno']))
{
$utente=$_POST['utente'];
$cuore=$_POST['cuore_meno'];
$sql="DELETE FROM `salvati` WHERE id_file='$cuore' and id_utente='$utente'";
$result = mysqli_query($conn, $sql);
}

if (isset($_POST['save'])) { // se viene cliccato il bottone salva
    // nome del file uploadato
    $materia=$_POST['materia'];
    $argomento=$_POST['argomento'];
    $cod=$_GET['codi'];
    $anno=$_POST['classe'];
    $filename = $_FILES['myfile']['name'];
    $sqlmail = "SELECT COUNT(*) as total FROM `file` WHERE nome LIKE '".$filename."'";
    $esegui = mysqli_query($conn, $sqlmail);
    $risultato = mysqli_fetch_assoc($esegui);
    if($risultato['total']!=0)
    {
        header("LOCATION: upload.php?eli=2");
        exit;
    }
    // destinazione del file uploadato
    $destination = 'uploads/' . $filename;

    // estensione del file
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // il file fisico in una cartella temporanea sul server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
    if (!in_array($extension, ['zip', 'pdf', 'docx','jpg', 'doc', 'odt'])) {
        
        echo "You file extension must be .zip, .pdf or .docx or .jpg or .doc or .odt";
        echo"<a href='upload.php'>ritorna alla pagina</a>";
    } elseif ($_FILES['myfile']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        
        // sposta il file nella cartella prestaibilita(uploads)
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO `file` ( argomento, nome, id_utente, id_materia, size, anno_scolastico,piaciuti) VALUES ('$argomento','$filename','$cod','$materia',$size,$anno,0)";
            if (mysqli_query($conn, $sql)) {
                header("LOCATION: upload.php?eli=1");
            }
        } else {
            echo "Failed to upload file.";
            echo "<a href='upload.php'>ritorna alla pagina</a>";
        }
    }
    exit;
}
#gestione cambio dati
if(isset($_GET['dati']))
{
    $cod=$_GET['id_utente'];
  $insert="UPDATE utente SET nome='".$_POST['nome']."', cognome='".$_POST['cognome']."', mail='".$_POST['mail']."', pw='".$_POST['password']."' WHERE id_utente='".$_GET['id_utente']."';";
  mysqli_query($conn,$insert);
  header("LOCATION: us.php");
}
#Gestione foto profilo

if (isset($_GET['up'])) { // se viene cliccato il bottone salva
    // nome del file uploadato
    $cod=$_GET['id_utente'];
    echo
    //$id_ut=$_GET['id'];
    $filename = $_FILES['foto']['name'];

    // destinazione del file uploadato
    $destination = 'images/' . $filename;

    // estensione del file
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // il file fisico in una cartella temporanea sul server
    $file = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];
    if (!in_array($extension, ['jpg', 'png', 'jpeg'])) {
        
        echo "You file extension must be .jpg or .png or jpeg";
        echo"<a href='upload.php'>ritorna alla pagina</a>";
    } elseif ($_FILES['foto']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        
        // sposta il file nella cartella prestaibilita(uploads)
        if (move_uploaded_file($file, $destination)) {
            $sql = "UPDATE utente SET foto='".$filename."' WHERE id_utente=".$cod;
            if (mysqli_query($conn, $sql)) {
                echo"ciao";
                header("LOCATION: us.php?id_utente=".$cod);
            }
        } else {
            echo "Failed to upload file.";
            echo "<a href='upload.php'>ritorna alla pagina</a>";
        }
    }
    exit;
}
#Download del file
if (isset($_GET['file_id'])) 
{

    $id = $_GET['file_id'];
    // recupera il file da scaricare dal database
    $sql = "SELECT * FROM `file` WHERE id_file=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['nome'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['nome']));
        readfile('uploads/' . $file['nome']);

        /* numero di file uplodati
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);*/
        exit;
    }

}
if(isset($_GET['delete']))
{
    $id = $_GET['id_file'];
    $sqldel="DELETE FROM `salvati` WHERE id_file='$id'";
    $result = mysqli_query($conn, $sqldel);
    $sql = "SELECT * FROM `file` WHERE id_file=$id";
    
    
    // recupera il file da eliminare dal database
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['nome'];
    if (unlink($filepath)) {
        //echo 'The file ' . $filepath . ' was deleted successfully!';
        $sql="DELETE FROM `file` WHERE id_file='$id'";
        $result = mysqli_query($conn, $sql);
        header("LOCATION: us.php?eli=1");
    }
    else {
        echo 'There was a error deleting the file ' . $filepath;
    }
    exit;
}
?>
