<?php
// untuk memulai session
session_start();


if ($_SESSION == NULL) {
    echo "<script> 
    alert ('harap login terlebih dahulu')
    window.location.href='login/index.php'
    </script>";
}

include "koneksi.php";
include "layout/header.php";
include "content.php";
include "layout/footer.php";