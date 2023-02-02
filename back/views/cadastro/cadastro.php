<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/globalStyle.css">
    <link rel="stylesheet" href="styles/style_cadastro.css">
    <title>Cadastro</title>
</head>

<body>
    <main class="main_form">
        <a class="voltar" href="/login">Voltar</a>

        <h1 class="h1_logo">Study Notes</h1>

        <form action="/realiza_cadastro" method="POST">
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
            <button>Enviar</button>
        </form>
    </main>
</body>

</html>