<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/globalStyle.css">
    <link rel="stylesheet" href="styles/style_dashboard.css">
    <title>Study Notes</title>
</head>

<body>
    <header>
        <h1>Study Notes</h1>
        <a class="logout" href="/logout">Sair</a>
    </header>

    <main>
        <section class="section_form">
            <form action="/salvar_notas" method="POST">
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

                <button class="botao_registrar">Registrar</button>
            </form>
        </section>

        <section class="section_anotacoes">
            <h3>Sua anotações <?php echo $_SESSION['nome']; ?></h3>
            <ul>
                <?php foreach ($notas as $note) : ?>
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