<?php

if (!isset($_SESSION['user'])) {
    header ("Location: /member/index.php");
}

?>
