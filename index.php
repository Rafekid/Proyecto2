<?php
include "layouts/head.php"; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "navbar.php"; ?>
<body>
   <section class="contenido wrapper">
       <div class="box">
            <div class="box-user" id="usuario">
                <a href="usuario/index.php">
                    <i class="fas fa-user fa-5x" aria-hidden="true"></i>
                    <p>Usuario</p>
                </a>
            </div>
            <div class="box-user" id="admin">
                <a href="loginAdmin.php">
                    <i class="fas fa-user-shield fa-5x" aria-hidden="true"></i>
                    <p>Admin</p>
                </a>
            </div>
       </div>
   </section>
 </body>
<?php include "layouts/footer.php" ?>
</html>