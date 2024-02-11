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
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>help</title>
        <!-- box icons  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
       

  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link rel="stylesheet" href="sidebar.css">
        <link rel="stylesheet" href="help.css"> 
    </head>
<body>
<?php 
    if(isset($_GET['inviato']))
    {
        form_inviata();
    }
    function form_inviata(){
        echo"<script>alert('il form è stato inviato con successo')</script>";
    }
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
    <div class="text">contattaci</div> 
    <div class="modulo">
        <form action="send.php" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">indirizzo email</label><br>
                <input type="email" name="nome" class="form-control mail" id="exampleFormControlInput1" placeholder="nome.cognome@sabin.istruzioneer.it" required="">
            </div>
            <div style="margin-top:2vh"class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">spiega il tuo problema</label><br>
            <textarea class="form-control" name="testo" id="exampleFormControlTextarea1" rows="10" required="" placeholder="scrivi qui..."></textarea><br>
            <button type="submit" class="upload btn inv" id="invio">invia segnalazione</button>
            </div>
        </form>
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