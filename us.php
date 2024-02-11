<?php 
include 'filesLogic.php';
session_start();
if(isset($_SESSION['id_utente']))
{
    $utente=$_SESSION['id_utente'];
    $utente=implode("",$utente);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>user</title>
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>profile with data and skills - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <!--css links-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="user.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
</head>
<body <?php if(isset($_GET['eli'])){echo"onload='eliminazione()'";}?>>
  <?php
            $host="xxx.xxx.xxx.xxx";
            $db_con = mysqli_connect($host, 'xxxxxxx', 'xxxxxx', 'xxxxxx');
            $id_utente=$utente;
            $ut=$utente;
            $sql="SELECT * FROM utente WHERE id_utente='".$id_utente."'";
            $execute = mysqli_query($conn, $sql);
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
                <a class="simbol" href='download.php'  >
                    <i class='bx bxs-download'></i>
                    <span class="links_name">download</span>
                </a>
                <span class="tooltip">download</span>
            </li>
            <li>
                <a class="simbol" href='upload.php'>
                <i class='bx bx-cloud-upload'></i>
                    <span class="links_name">upload</span>
                </a>
                <span class="tooltip">upload</span>
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
        <div class="text">user</div>
    
      <div class="container">
        <div class="main-body">
          <!-- /Breadcrumb -->

          <div class="row gutters-sm griglia"  >
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="images/<?php echo $row['foto'];?>" alt="Admin" class="rounded-circle" width="150">
                      <h4><?php echo $id_utente;?></h4>
                      <p class="text-secondary mb-1">studente   </p>
                      <form action="filesLogic.php?up=1&id_utente=<?php echo $row['id_utente'];?>" method="post" enctype="multipart/form-data">
                        <input onchange="show()" type="file" name="foto" id="upload" hidden/>
                        <label for="upload" class="upload btn">change image</label>
                        <button type="submit" class="upload btn inv" style="visibility:hidden; width:0;"id="invio">invio</button>
                      </form>
                    </div>
                </div>
              </div>  
              <div class="dati card">
                <div class="card-body">
                  <form action="filesLogic.php?dati=1&id_utente=<?php echo $row['id_utente'];?>" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">nome</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo "<input name='nome' required='' class='edit' type='text' value='".$row['nome']."'>";?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">cognome</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo "<input name='cognome' required='' class='edit' type='text' value='".$row['cognome']."'>";?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo "<input name='mail' required='' class='edit' type='text' value='".$row['mail']."'>";?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">ruolo</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo "".$row['ruolo']?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo "<input name='password' required='' class='edit' type='text' value='".$row['pw']."'>";?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <button class="btn" style="width:60px;"type="submit">Edit</button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive-lg">
          <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">argomento</th>
                  <th scope="col">nome file</th>
                  <th scope="col">dimensione(MB)</th>
                  <th scope="col">rimuovi file</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($user_file as $file):?>
                      <tr>
                          <td><?php echo $file['argomento']; ?></td>
                          <td><?php echo $file['nome']; ?></td>
                          <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
                          <td><a class="elimin" href="filesLogic.php?id_file=<?php echo $file['id_file'] ?>&&delete=vero">elimina</a></td>
                      </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
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
        function eliminazione(){
          alert("il file è stato eliminato");
        }
        function show(){
          document.getElementById("invio").style.visibility="visible";
          document.getElementById("invio").style.width="100px";
          document.getElementById("invio").style.padding="15px";
        }
    </script>
</body>
</html>