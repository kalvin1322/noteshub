<?php 
include 'filesLogic.php';              
session_start();
if(isset($_GET['aggiorna'])){
    session_destroy();
    header("LOCATION: index.php");
}   
if(isset($_SESSION['id_utente']))
{
    $utente=$_SESSION['id_utente'];
    $utente=implode("",$utente);
}

    ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
       <style>
 
        
       </style>
        <meta charset="UTF-8">
        <title>index</title>
        <!-- box icons  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
       

  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link rel="stylesheet" href="sidebar.css">
        <link rel="stylesheet" href="index.css"> 
    </head>
<body>
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
                <a class="simbol" href='download.php'>
                    <i class='bx bxs-download'></i>
                    <span class="links_name">download</span>
                </a>
                <span class="tooltip">download</span>
            </li>
            <li>
                <a class="simbol" <?php if(isset($_SESSION['id_utente'])){echo"href='us.php'";}else{ echo"onclick='controllo()'";}?>>
                    <i class='bx bx-user' ></i>
                    <span class="links_name">user</span>
                </a>
                <span class="tooltip">user</span>
            </li>
            <li>
                <a class="simbol" <?php if(isset($_SESSION['id_utente'])){echo"href='upload.php'";}else{ echo"onclick='controllo()'";}?>>
                <i class='bx bx-cloud-upload'></i>
                    <span class="links_name">upload</span>
                </a>
                <span class="tooltip">upload</span>
            </li>
            <li>
                <a class="simbol" <?php if(isset($_SESSION['id_utente'])){echo"href='liked.php'";}else{ echo"onclick='controllo()'";}?>>
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
    </div>
    <div class="home_content" style="overflow-y:scroll;">
        <div class="header">
            <div class="testo container-fluid"><h1>NoteHub</h1></div>
        </div>
        <div class="contenitore text-center">   
            <div class="intro" style="width:100%;"> 
                <h2>cosa puoi fare?</h2>
                    <div class="griglia">
                        <div class="griglia_foto">
                            <img src="down_appunti.png">
                        </div>
                        <div style="grid-column:2/5"class="">
                        <h3>SCARICARE APPUNTI</h3>
                            <p class="spiegazione">questa piattaforma offre un'ampia gamma di appunti che vanno da materie umanistiche a quelle scientifiche. Gli appunti sono stati creati da altri studenti 
                                che li hanno gentilmente messi a disposizione di tutti nella speranza di dare una mano. se hai bisogno anche te di qualcosa basta che vai nella sezione download e potrai cercare
                            e scaricare gli appunti di cui hai bisogno</p>
                        </div>
                    </div>
                    <div class="griglia2">
                        <div class="griglia_testo">
                        <h3 style="text-align:left; padding-left:20px">CARICARE APPUNTI</h3>
                            <p class="spiegazione">ovviamente è sempre un po' difficile mettere a disposizione del materiale per il quale si è lavorato tanto, nonostante questo invitiamo tutti a caricare il materiale
                                scolastico, che siano appunti, compiti, foto di libri, per il buon funzionamento del sito e soprattutto per dare una mano a chi magari fa un po' fatica. Grazie per il tuo contributo in 
                                anticipo!
                            </p>
                        </div>  
                        <div style="border-left:1px solid black" class=""> 
                            <img src="upload_appunti.png">
                        </div>
                    </div>
                    <div class="griglia" style="margin-bottom:20px;">
                        <div class="griglia_foto" style="margin-top:20px">
                            <img src="regolamento.jpg">
                        </div>
                        <div style="grid-column:2/5"class="">
                        <h3>REGOLAMENTO</h3>
                            <p class="spiegazione">essendo un mezzo aperto a tutti e che ha lo scopo di aiutare chiunque ne abbia bisogno sarebbe opportuno avere un comportamento corretto verso le risorse messe a 
                                disposizione. L'upload di materiale inappropriato porta alla conseguente eliminazione dell'account e quindi l'impossibilità di accedere ai servizi. Nel caso si venisse a contatto con materiale 
                                caricato sul sito o se si scoprisse qualche bug si prega di mandare una segnalazione nella sezione "help" del sito con nome del file da eliminare. 
                                <br> speriamo ti possa essere d'aiuto il sito!
                            </p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let searchbtn = document.querySelector(".bx-search-alt-2");
        btn.onclick = function(){
            sidebar.classList.toggle("active")
        }
        function controllo(){
            alert("non hai fatto il log-in! accedere per vedere i tuoi dati e tanto altro!");
          }

    </script>
    <?php  
        function startUser(){
        header("LOCATION: us.php");
        }
        if(isset($utente))
        {
            if(isset($_GET['via']))
            {
                startUser();  
            }
        }
        
        ?>
</body>
</html>