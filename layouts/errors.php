<?php
$error =  isset($_SESSION["error"]) ? $_SESSION["error"]."" :"";
$success =  isset($_SESSION["success"]) ? $_SESSION["success"]."" :"";



if ($error):
    ?>
    <p class="error"><?php echo $error?></p>
<?php

    unset($_SESSION['error']);

endif ?>

<?php

if ($success):
?>
    <p class="success"><?php echo $success?></p>
<?php


    unset($_SESSION['success']);

endif ?>
