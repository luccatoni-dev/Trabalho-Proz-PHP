<?php
include 'conexao.php';
use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    
    // Verifica se o usuário existe
    $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($usuario_id);
        $stmt->fetch();

        // Gera um código de redefinição
        $codigo_redefinicao = uniqid();
        $stmt = $conexao->prepare("INSERT INTO codigos_redefinicao (usuario_id, codigo) VALUES (?, ?)");
        $stmt->bind_param("is", $usuario_id, $codigo_redefinicao);
        $stmt->execute();

        // Envia o código por e-mail
        $mail = new PHPMailer(true);
        try {
            $mail->setFrom('no-reply@seusite.com', 'Seu Site');
            $mail->addAddress($email);
            $mail->Subject = 'Redefinir Senha';
            $mail->Body    = "Use o código abaixo para redefinir sua senha: $codigo_redefinicao";
            $mail->send();
            echo "Verifique seu e-mail!";
        } catch (Exception $e) {
            echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
        }
    } else {
        echo "E-mail não encontrado.";
    }
}
?>
