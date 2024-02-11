<?php 
//argomento LIKE '".$_POST['aggiorna']."%' or argomento LIKE '".$_POST['aggiorna']."'"
include 'filesLogic.php';
session_start();
$c=-1;
if(isset($_GET['id_utente']))
{
  $link="'user.php?id_utente=".$_GET['id_utente']."'";
}
else
{
  $id_utente="<i class='fa-thin fa-person-to-portal'></i>log-in</a>";
}
if(isset($_SESSION['id_utente']))
{
    $utente=$_SESSION['id_utente'];
    $utente=implode("",$utente);
}
if(isset($_SESSION['id_utente']))
{
    $query = "SELECT * FROM `file`, salvati WHERE salvati.id_utente=$utente AND salvati.id_file=file.id_file";
    $risultato = mysqli_query($conn, $query);
    $salvati=mysqli_fetch_all($risultato, MYSQLI_ASSOC);
}

    ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <title>download</title>
        <meta charset="UTF-8">
        <title>Responsive Sidebar Menu </title>
        <link rel="stylesheet" href="sidebar.css">
        <!-- box icons <link rel="stylesheet" href="stile.css?v=">-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="stile.css">
        
        <title>Download files</title>
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
                <a class="simbol" href='index.php'>
                    <i class='bx bxs-home'></i>
                    <span class="links_name">home</span>
                </a>
                <span class="tooltip">home</span>
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
        
        if(isset($_SESSION['id_utente']))
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
        <div class="text">downloads</div>
        <div class="container">            
    <!--creazione tabella-->
        <div class="rice_container">   
            <div class="ricerca">
            <input type="text" id="ric"  placeholder="cerca qui il tuo file ...">
            <i class='bx bx-search-alt-2' ></i>
            <p id="demo"></p>
            
            </div>
    </div>
            <div class="table-responsive-lg margini">
                <table  class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">materia</th>
                            <th scope="col">argomento</th>
                            <th scope="col">anno_scolastico</th>
                            <th scope="col">nome file</th>
                            <th scope="col">dimensione</th>
                            <th scope="col">salva</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tabella" >
                        <?php foreach ($files as $file): ?>
                        <tr>
                            <td><?php echo $file['id_materia']; ?></td>
                            <td id="prova"><?php echo $file['argomento']; ?></td>
                            <td style="text-align:center;"><?php echo $file['anno_scolastico']; ?></td>
                            <td><?php echo $file['nome']; ?></td>
                            <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
                            <td>
                                <i <?php
                                if(isset($_SESSION['id_utente']))
                                {
                                    $query = "SELECT * FROM salvati WHERE salvati.id_utente=$utente AND salvati.id_file=".$file['id_file'];
                                    $risultato = mysqli_query($conn, $query);
                                    $salvati=mysqli_fetch_assoc($risultato);
                                    if($salvati==false)
                                    {
                                        echo"class='bx bx-heart'";
                                    }
                                    else
                                    {
                                        echo"class='bx bxs-heart attivo'";
                                    }
                                }
                                else
                                {
                                    echo"class='bx bx-heart'";
                                }
                                ?> style="cursor:pointer" <?php if(isset($_SESSION['id_utente'])){echo"onclick=test('".$file['id_file']."')";}else{ echo"onclick=controllo()"; } ?> id="<?php echo $file['id_file']?>">
                                </i>
                            </td>
                            <td><a <?php if(isset($_SESSION['id_utente'])){echo"href='filesLogic.php?file_id=".$file['id_file']."'";}else{ echo"onclick=controllo()";} ?>>Download</a></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
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
        function test(n){
            main=document.getElementById(n);
            if(main.classList.contains("attivo")==false)
            {
                main.className="bx bxs-heart"
                main.classList.toggle("attivo");
                $.ajax({
                    url:"filesLogic.php",
                    method:"post",
                    data: {"cuore_piu" : n, "utente" : <?php if(isset($utente)){echo($utente);}else{echo("ciao");}?> },
                    dataType:'text',
                    success: function result(){
                    }
                });
            }
            else{
                main.className="bx bx-heart"
                $.ajax({
                    url:"filesLogic.php",
                    method:"post",
                    data: {"cuore_meno" : n, "utente" : <?php if(isset($utente)){echo($utente);}else{echo("ciao");}?> },
                    dataType:'text',
                    success: function result(){
                    }
                });
            }
        
        }
        function controllo(){
            alert("non hai fatto il log-in! accedere per vedere i tuoi dati, scaricare e tanto altro!");
          }
         function prova(){
            alert("ciao")
         }

        function cambio() {
        parola=document.getElementById("ricerca").value;
        $.ajax({
            url: 'fileLogic.php',
            type: 'post',
            data: { "aggiorna": parola},
            success: function(value) { alert(value)}
        });
        }
        //FILTER SEARCH BAR
        $(document).ready(function(){
            $("#ric").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tabella tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            });
            
        </script>
    <?php  

        function startUser(){
        header("LOCATION: us.php?id_utente=".$utente);
        }
        if(isset($_GET['id_utente']))
        {
            if(isset($_GET['via']))
            {
                startUser();  
            }
        }
        
        ?>
</body>
</html>
