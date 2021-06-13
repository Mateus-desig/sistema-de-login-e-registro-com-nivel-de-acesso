<?php
    include ('conexao.php');

    if(empty($_POST['email']) || empty($_POST['senha'])) {
        header("Location: ../index.php");
        exit();
    }
    // Pegar dados do formulario de resgistro
    $email = mysqli_real_escape_string($conn ,$_POST['email']);
    $senha = mysqli_real_escape_string($conn ,$_POST['senha']);

    $query = "SELECT id, nome, nivel FROM login_tb WHERE email = '$email' AND senha = '$senha'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) != 1) {
        // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
        echo "Login inválido!"; exit;
    } else {
        // Salva os dados encontados na variável $resultado
        $resultado = mysqli_fetch_assoc($result);
        // Se a sessão não existir, inicia uma
        if (!isset($_SESSION)) session_start();

        // Salva os dados encontrados na sessão
        $_SESSION['UsuarioID'] = $resultado['id'];
        $_SESSION['UsuarioNome'] = $resultado['nome'];
        $_SESSION['UsuarioNivel'] = $resultado['nivel'];

        // Redirecionar o visitente
        header('Location: ../restrito.php');exit;
    }