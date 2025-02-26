<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    $destinatario = "seuemail@gmail.com"; // Substitua pelo seu email
    $assunto = "Nova inscrição para vaga";
    $corpo = "Nome: " . $nome . "\nEmail: " . $email . "\nTelefone: " . $telefone . "\n";

    // Processar o arquivo
    if (isset($_FILES["curriculo"]) && $_FILES["curriculo"]["error"] == 0) {
        $arquivo_nome = $_FILES["curriculo"]["name"];
        $arquivo_temp = $_FILES["curriculo"]["tmp_name"];
        $arquivo_destino = "uploads/" . $arquivo_nome; // Crie a pasta "uploads" no seu servidor

        if (move_uploaded_file($arquivo_temp, $arquivo_destino)) {
            $corpo .= "\nCurrículo: " . $arquivo_destino;
        } else {
            $corpo .= "\nErro ao enviar o currículo.";
        }
    } else {
        $corpo .= "\nNenhum currículo enviado.";
    }

    // Cabeçalhos para evitar que o email vá para o spam
    $headers = "From: " . $email . "\r\n" .
               "Reply-To: " . $email . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if (mail($destinatario, $assunto, $corpo, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem.";
    }
}
?>