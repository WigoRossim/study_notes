<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/globalStyle.css">
    <link rel="stylesheet" href="styles/loginStyle.css">
    <title>Login</title>
</head>

<body>
    <main class="main_form">
        <h1 class="h1_logo">Study Notes</h1>
        <form action="/realiza_login" method="POST">
            <h2>Login</h2>
            <div>
                <label for="email">email</label>
                <input type="email" placeholder="Digite seu email" name="email" id="email">
            </div>

            <div>
                <label for="password">password</label>
                <input type="password" placeholder="Digite sua senha" name="password" id="password">
            </div>
            <button>Entrar</button>
            <p>Não possue conta? <span><a href="/cadastro">Cadastrar-se</a></span></p>
        </form>
    </main>
</body>

</html>