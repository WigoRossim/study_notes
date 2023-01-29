<?php

use Wigo\StudyNotes\Repository\UserRepository;


require_once __DIR__ . "/../back/vendor/autoload.php";
require_once __DIR__ . "/../back/src/services/redireciona.php";


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (strlen($_POST['email']) > 0 && strlen($_POST['password']) > 0) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userRepository = new UserRepository();
        $userRepository->login($email, $password);

        redireciona('/study_notes/front/dashboard/dashboard.php');
    } else {
        redireciona('/study_notes/front/pages_errors/falha_ao_logar.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global_style.css">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <main class="main_form">
        <h1 class="h1_logo">Study Notes</h1>
        <form action="index.php" method="POST">
            <h2>Login</h2>
            <div>
                <label for="">email</label>
                <input type="email" placeholder="Digite seu email" name="email">
            </div>

            <div>
                <label for="">password</label>
                <input type="password" placeholder="Digite sua senha" name="password">
            </div>
            <button type="submit">Entrar</button>
            <p>Não possue conta? <span><a href="cadastro/cadastro.php">Cadastrar-se</a></span></p>
        </form>
    </main>
</body>

</html>