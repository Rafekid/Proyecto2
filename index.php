<?php
include "layouts/head.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "navbar.php"; ?>
<body>
   <section class="contenido wrapper">

       <h1 class="text-center main-color">Bienvenido a UMG-Bank</h1>
       <p class="text-center main-color">Para iniciar elije tu tipo de usuario.</p>
       <div class="box">
            <div class="box-user" >
                <a href="usuario/index.php">
                    <i class="fas fa-user fa-5x" aria-hidden="true"></i>
                    <p>Usuario</p>
                </a>
            </div>
           <div class="box-user">
               <a href="loginAdmin.php">
                   <i class="fas fa-user-shield fa-5x" aria-hidden="true"></i>
                   <p>Admin</p>
               </a>
           </div>
           <div class="box-user">
               <a href="cajero/login.php">
                   <i class="fas fa-user-tie fa-5x" aria-hidden="true"></i>
                   <p>Cajero</p>
               </a>
           </div>
       </div>
   </section>
 </body>
<?php include "layouts/footer.php" ?>
</html>