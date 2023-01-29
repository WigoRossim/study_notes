<?php

require_once "redireciona.php";


if (!isset($_SESSION)) {
    session_start();
}

session_destroy();

redireciona("../../../front/index.php");
