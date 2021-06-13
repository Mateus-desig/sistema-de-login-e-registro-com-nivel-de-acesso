<?php
    include ('conexao.php');
    session_start();
    
    if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
        header("Location: ../registrar.php");
        exit();
    }
    // Pegar dados do formulario de resgistro
    $nome = mysqli_real_escape_string($conn ,$_POST['nome']);
    $email = mysqli_real_escape_string($conn ,$_POST['email']);
    $senha = mysqli_real_escape_string($conn ,$_POST['senha']);
    $nivel = mysqli_real_escape_string($conn ,$_POST['nivel']);

    // Inserir dados no banco de dados
    $insert = "INSERT INTO login_tb (nome,email,senha,nivel) VALUES ('$nome','$email','$senha','$nivel')";
    if(mysqli_query($conn, $insert)){
        header("Location: ../index.php");
    }else{
        $_SESSION['msg'] = "<p style='color:red;text-align:center;-webkit-touch-callout: none;-webkit-user-select: none;-khtml-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;'>erro ao enviar o registro</p>";
        header("Location: ../registrar.php");
    }
