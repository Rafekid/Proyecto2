<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 10/1/2020
 * Time: 3:21 AM
 */

if (UserController::instance()->check()) {
    header("location: ./index.php");
}