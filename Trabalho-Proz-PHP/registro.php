<?php
include 'conexao.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do usuário
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // Cria o hash da senha


    // Insere o usuário no banco de dados
    $stmt = $conexao->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();

    // Gera um código de verificação
    $codigo_verificacao = uniqid();
    $usuario_id = $conexao->insert_id;

    // Insere o código de verificação na tabela
    $stmt = $conexao->prepare("INSERT INTO codigos_verificacao (usuario_id, codigo) VALUES (?, ?)");
    $stmt->bind_param("is", $usuario_id, $codigo_verificacao);
    $stmt->execute();

    // Envia o código por e-mail
    $mail = new PHPMailer(true);
    try {
        $mail->setFrom('no-reply@seusite.com', 'Seu Site');
        $mail->addAddress($email);
        $mail->Subject = 'Verifique seu E-mail';
        $mail->Body    = "Use o código abaixo para verificar sua conta: $codigo_verificacao";
        $mail->send();
        echo "Verifique seu e-mail!";
    } catch (Exception $e) {
        echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
    }
}
?>
