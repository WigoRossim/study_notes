<?php

use Wigo\StudyNotes\Controller\CadastrarUser;
use Wigo\StudyNotes\Controller\ListarNotas;
use Wigo\StudyNotes\Controller\LoginUser;
use Wigo\StudyNotes\Controller\Logout;
use Wigo\StudyNotes\Controller\PageCadastro;
use Wigo\StudyNotes\Controller\PageDashBoard;
use Wigo\StudyNotes\Controller\PageLogin;
use Wigo\StudyNotes\Controller\RegistrarNota;

$routes = [
    "/realiza_cadastro" => CadastrarUser::class,
    "/cadastro" => PageCadastro::class,
    "/realiza_login" => LoginUser::class,
    "/login" => PageLogin::class,
    "/dashboard" => PageDashBoard::class,
    "/salvar_notas" => RegistrarNota::class,
    "/listar_notas" => ListarNotas::class,
    "/logout" => Logout::class
];


return $routes;
