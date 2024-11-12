<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    
    // Verifica o código
    $stmt = $conexao->prepare("SELECT usuario_id FROM codigos_verificacao WHERE codigo = ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Ativa a conta do usuário
        $stmt->bind_result($usuario_id);
        $stmt->fetch();
        $stmt = $conexao->prepare("UPDATE usuarios SET verificado = TRUE WHERE id = ?");
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        echo "Conta verificada com sucesso!";
    } else {
        echo "Código inválido!";
    }
}

?>
