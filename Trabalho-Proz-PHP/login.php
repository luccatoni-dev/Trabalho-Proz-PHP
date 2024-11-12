<?php
session_start();
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o usuário existe
    $stmt = $conexao->prepare("SELECT id, senha, verificado FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $senha_hash, $verificado);
        $stmt->fetch();
        
        // Verifica a senha
        if (password_verify($senha, $senha_hash)) {
            if ($verificado) {
                $_SESSION['user_id'] = $id;
                header("Location: pagina_principal.php");
            } else {
                echo "Por favor, verifique seu e-mail.";
            }
        } else {
            echo "E-mail ou senha inválidos.";
        }
    } else {
        echo "Usuário não encontrado.";
    }

    if (isset($_POST['lembrar_me'])) {
        setcookie('user_id', $_SESSION['user_id'], time() + 3600 * 24 * 30, '/'); // Cookie válido por 30 dias
    }
    
    if (isset($_COOKIE['user_id'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    }
    
}

?>
