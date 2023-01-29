<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    die("Voce precisa estar logado para acessar esta pagina. <span><a href=\"../../front/index.php\">Login</a></span>");
}
