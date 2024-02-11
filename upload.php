<?php include 'filesLogic.php';
$sql="select * from materia";
$result = mysqli_query($conn, $sql);
$materia=mysqli_fetch_all($result, MYSQLI_ASSOC);
session_start();
if(isset($_SESSION['id_utente']))
{
    $utente=$_SESSION['id_utente'];
    $utente=implode("",$utente);
}
?>
<html lang="en">
  <head>
    <link rel="stylesheet" href="stile.css">
    <title>Files Upload and Download</title>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>profile with data and skills - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--css links-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="upload.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
  </head>
  <body <?php if(isset($_GET['eli'])){echo"onload='eliminazione(".$_GET['eli'].")'";}?>>
  <?php
  $host="xxx.xxx.xxx.xxx";

            $db_con = mysqli_connect($host, 'xxxxxxx', 'xxxxxx', 'xxxxxx');
            $id_utente=$utente;
            $ut=$utente;
            $sql="SELECT * FROM utente WHERE id_utente='".$id_utente."'";
            $execute = mysqli_query($db_con, $sql);
            $row = mysqli_fetch_assoc($execute);
                //$sql = "SELECT * FROM `file` WHERE `file`.id_utente = ".$_GET['id_utente']."";
                $sql = "SELECT * FROM `file` WHERE `file`.id_utente='".$id_utente."'";
                $result = mysqli_query($db_con, $sql);
                $user_file = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $id_utente=$row['nome']." ".$row['cognome'];
            
    ?>
    <div class="sidebar">
    <div class="profile_content sopra">
        <?php 
        
        if(isset($utente))
        {
            $id_utente=$utente;
            $sql="SELECT * FROM utente WHERE id_utente='".$id_utente."'";
            $execute = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($execute);
            $id_utente=$row['nome']." ".$row['cognome'];
            echo"<div class='profile'>
                <div class='profile_details'>
                <img src='images/".$row['foto']."'>
                    <div class='name_job'>
                        <div class=name'>".$id_utente."</div>
                        <div class='job'>".$row['ruolo']."</div>
                    </div>
                </div>
                <a href='index.php?aggiorna=1' class='log'><i class='bx bx-log-out' id='log_out'></i></a>
                </div>";
        }
        else
        {
        $id_utente="<a><i class='fa-thin fa-person-to-portal'></i>log-in</a>";
        echo"<div class='profile'>
                <div class='profile_details'>
                    <div class='name_job'>
                        <div class=name'><a class='log in' href='login.php'>log-in</a></div>
                    </div>
                </div>
                <a  href='login.php' class='log'><i class='bx bx-log-in' id='log_out'></i></a>
            </div>"; 
        }
        ?>
        </div>
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxs-school'></i>
                <div class="logo_name">appunti sabin</div>
            </div>
            <i class='bx bx-menu' id="btn" ></i>
        </div>
        <ul class="nav_list" >
            <li>
                <a class="simbol" href='index.php'>
                    <i class='bx bxs-home'></i>
                    <span class="links_name">home</span>
                </a>
                <span class="tooltip">home</span>
            </li>
            <li>
                <a class="simbol" href='download.php'>
                    <i class='bx bxs-download'></i>
                    <span class="links_name">download</span>
                </a>
                <span class="tooltip">download</span>
            </li>
            <li>
                <a class="simbol" href='us.php?via=1'>
                    <i class='bx bx-user' ></i>
                    <span class="links_name">user</span>
                </a>
                <span class="tooltip">user</span>
            </li>
            <li>
                <a class="simbol" href="liked.php">
                    <i class='bx bx-heart' ></i>
                    <span class="links_name">salvati</span>
                </a>
                <span class="tooltip">salvati</span>
            </li>
            <li>
                <a class="simbol" href="help.php">
                <i class='bx bx-help-circle'></i>
                    <span class="links_name">help</span>
                </a>
               <span class="tooltip">help</span>
            </li>
        </ul>
        <div class="profile_content sotto">
        <?php             
            echo"<div class='profile'>
                <div class='profile_details'>
                <img src='images/".$row['foto']."'>
                    <div class='name_job'>
                        <div class=name'>".$id_utente."</div>
                        <div class='job'>".$row['ruolo']."</div>
                    </div>
                </div>
                <a href='index.php?aggiorna=1' class='log'><i class='bx bx-log-out' id='log_out'></i></a>
                </div>";
        ?>
      </div>
    </div>
    <div class="home_content">
        <div class="text">uplaod</div>
        <div class="container">
      <div>
        <form <?php echo"action='filesLogic.php?codi=".$utente."'";?> method="post" name="modulo"enctype="multipart/form-data"  >
          <div>
            <h3>Upload File</h3>
            <p class="text">scegli materia:

              <select name="materia" onchange="costruzione()">
              <?php foreach ($materia as $file): ?>
              <option value='<?php echo $file['id_materia']?>'><?php echo $file['id_materia']?></option>
              <?php endforeach;?>
            </select ></p>
            <p class="testo">inserisci argomento:<input type="text" max=255; name="argomento" required=""></p>
            <p class="testo">inserisci classe:<input type="text" max=4; min=4; name="classe" required=""></p>
            <div class="col-md-6">
               <div class="form-group files color">
                    <input type="file" name="myfile" class="form-control" multiple="">
                  </div>          
            </div>
            <button type="submit" name="save">upload</button>
          </div>
          <div>
        </form>
      </div>
    </div>
  <script>
        let botn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let searchbtn = document.querySelector(".bx-search-alt-2");
        botn.onclick = function(){
            sidebar.classList.toggle("active");
        }
        searchbtn.onclick = function(){
            sidebar.classList.toggle("active");
        }
        function eliminazione(n){
          if(n==1)
          {
              alert("il file è stato caricato");
              window.location.href = "upload.php";
          }
          else if(n==2)
          {
            alert("il file è già stato caricato, se vuoi ricarcarlo cambia il nome del file");
          }
        } 
        
    </script>
</body>
</html>