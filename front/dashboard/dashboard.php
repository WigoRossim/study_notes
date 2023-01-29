<?php

use Wigo\StudyNotes\Repository\UserRepository;

require_once  __DIR__ . "/../../back/src/services/protect.php";
require_once __DIR__ . "/../../back/vendor/autoload.php";
require_once __DIR__ . "/../../back/src/services/redireciona.php";

$userRepository = new UserRepository();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (strlen($_POST['titulo']) > 0 && strlen($_POST['nivel']) > 0 && strlen($_POST['descricao']) > 0) {
        $titulo = $_POST['titulo'];
        $nivel = $_POST['nivel'];
        $descricao = $_POST['descricao'];

        $userRepository->addNewNote($_SESSION['user_id'], $titulo, $nivel, $descricao);
        redireciona("dashboard.php");
    }
}

$listNotes = $userRepository->listNotes($_SESSION["user_id"])

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../global_style.css">
    <link rel="stylesheet" href="style_dashboard.css">
    <title>Study Notes</title>
</head>

<body>
    <header>
        <h1>Study Notes</h1>
        <a class="logout" href="../../back/src/services/logout.php">Sair</a>
    </header>

    <main>
        <section class="section_form">
            <form action="dashboard.php" method="POST">
                <h2>Criar Anotação</h2>
                <div>
                    <label for="">Titulo</label>
                    <input type="text" placeholder="Digite o titulo" name="titulo">
                </div>

                <div>
                    <label for="">Nivel</label>
                    <select name="nivel">
                        <option value="basico">Basico</option>
                        <option value="intermediario">Intermediário</option>
                        <option value="avancado">Avançado</option>
                    </select>
                </div>

                <div>
                    <label for="">Descrição</label>
                    <textarea name="descricao" cols="30" rows="20" placeholder="Digite sua anotação"></textarea>
                </div>

                <button type="submit" class="botao_registrar">Registrar</button>
            </form>
        </section>

        <section class="section_anotacoes">
            <h3>Sua anotações <?php echo $_SESSION['nome']; ?></h3>
            <ul>
                <?php foreach ($listNotes as $note) : ?>
                    <li>
                        <h3><?php echo $note->titulo; ?></h3>
                        <span class="<?php echo $note->nivel; ?>"><?php echo $note->nivel; ?></span>
                        <p>
                            <?php echo $note->descricao; ?>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</body>

</html>