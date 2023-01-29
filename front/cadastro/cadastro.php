<?php

use Wigo\StudyNotes\Repository\UserRepository;

require_once __DIR__ . "/../../back/vendor/autoload.php";
require_once __DIR__ . "/../../back/src/services/redireciona.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (strlen($_POST['nome']) > 0 && strlen($_POST['email']) > 0 && strlen($_POST['password']) > 0) {
        $userRepository = new UserRepository();
        $userRepository->registerUser($_POST['nome'], $_POST['email'], $_POST['password']);
        redireciona('/study_notes/front/index.php');
    } else {
        echo "<span class=\"toast\">Preencha todos os campos <p>X</p></span>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../global_style.css">
    <link rel="stylesheet" href="style_cadastro.css">
    <title>Cadastro</title>
</head>

<body>
    <main class="main_form">
        <a class="voltar" href="../index.php">Voltar</a>

        <h1 class="h1_logo">Study Notes</h1>

        <form action="cadastro.php" method="POST">
            <h2>Cadastro</h2>
            <div>
                <label for="nome">Nome</label>
                <input type="text" name="nome" placeholder="Digite seu nome" id="nome">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Digite seu email" id="email">
            </div>

            <div>
                <label for="password">Senha</label>
                <input type="password" name="password" placeholder="Digite sua senha" id="password">
            </div>
            <button type="submit">Enviar</button>
        </form>
    </main>
</body>

</html>