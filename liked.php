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
$sql = "SELECT * FROM `file`, salvati WHERE salvati.id_utente=$utente AND salvati.id_file=file.id_file";
$result = mysqli_query($conn, $sql);
$salvati=mysqli_fetch_all($result, MYSQLI_ASSOC);
// the message
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
       <style>
 
        
       </style>
        <meta charset="UTF-8">
        <title>liked</title>

        <!-- box icons-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="sidebar.css">
        <link rel="stylesheet" href="liked.css">    
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
            <li style="display:none;">
                
                    <i class='bx bx-search-alt-2' ></i>
                    <input type="text" placeholder="search...">
                    
                    <span class="tooltip">search</span>
            </li>
            <li>
                <a href='index.php'>
                    <i class='bx bxs-home'></i>
                    <span class="links_name">home</span>
                </a>
                <span class="tooltip">home</span>
            </li>
            <li>
                <a href='download.php'>
                    <i class='bx bxs-download'></i>
                    <span class="links_name">download</span>
                </a>
                <span class="tooltip">download</span>
            </li>
            <li>
                <a <?php if(isset($_SESSION['id_utente'])){echo"href='us.php'";}else{ echo"onclick='controllo()'";}?>>
                    <i class='bx bx-user' ></i>
                    <span class="links_name">user</span>
                </a>
                <span class="tooltip">user</span>
            </li>
            <li>
                <a <?php if(isset($_SESSION['id_utente'])){echo"href='upload.php'";}else{ echo"onclick='controllo()'";}?>>
                <i class='bx bx-cloud-upload'></i>
                    <span class="links_name">upload</span>
                </a>
                <span class="tooltip">upload</span>
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
    <div class="home_content">
        <div class="text">salvati</div> 
        <header><h2>in questa sezione potrai visualizzare i file salvati</h2></header>
        <div class="piaciuti table-responsive-lg margini">
        <table  class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">materia</th>
                    <th scope="col">argomento</th>
                    <th scope="col">anno_scolastico</th>
                    <th scope="col">nome file</th>
                    <th scope="col">dimensione</th>
                    <th scope="col">like</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tabella">
            <?php foreach ($salvati as $file): ?>
            <tr>
                <td><?php echo $file['id_materia']; ?></td>
                <td id="prova"><?php echo $file['argomento']; ?></td>
                <td style="text-align:center;"><?php echo $file['anno_scolastico']; ?></td>
                <td><?php echo $file['nome']; ?></td>
                <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
                <td>
                <i class='bx bxs-heart' style="cursor:pointer" <?php echo"onclick=elimina_salvato('".$file['id_file']."')";;?>></i>
                </td>
                <td><a <?php if(isset($_SESSION['id_utente'])){echo"href='filesLogic.php?file_id=".$file['id_file']."'";}else{ echo"onclick=controllo()";} ?>>Download</a></td>
            </tr>
            <?php endforeach;?>
            </tbody>
            </table>
        </div>
    </div>
    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let searchbtn = document.querySelector(".bx-search-alt-2");
        btn.onclick = function(){
            sidebar.classList.toggle("active")
        }
        searchbtn.onclick = function(){
            sidebar.classList.toggle("active")
        }
        function controllo(){
            alert("non hai fatto il log-in! accedere per vedere i tuoi dati e tanto altro!");
          }
          function elimina_salvato(n){
            $.ajax({
                    url:"filesLogic.php",
                    method:"post",
                    data: {"cuore_meno" : n, "utente" : <?php echo($utente);?> },
                    dataType:'text',
                    success: function result(){
                        window.location.reload();
                    }
                });
          }
    </script>
    <?php  
        function startUser(){
        header("LOCATION: us.php");//id_utente=".$_GET['id_utente']
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