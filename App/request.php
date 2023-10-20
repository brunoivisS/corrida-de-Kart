<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o arquivo foi enviado sem erros
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $arquivoTemporario = $_FILES["file"]["tmp_name"];
        $nomeArquivo = $_FILES["arquivo"]["name"];

        // Verifica a extensão do arquivo
        $extensaoPermitida = "log";
        echo $nomeArquivo;
        $extensaoArquivo = pathinfo($nomeArquivo, PATHINFO_EXTENSION);

        if (strtolower($extensaoArquivo) == strtolower($extensaoPermitida)) {
            // Move o arquivo para o diretório desejado
            $diretorioDestino = "tmp/log";
            $caminhoCompleto = $diretorioDestino . $nomeArquivo;

            move_uploaded_file($arquivoTemporario, $caminhoCompleto);

            echo "Upload bem-sucedido!";
        } else {
            echo $extensaoArquivo;
        }
    } else {
        echo "Erro no envio do arquivo.";
    }
} else {
    echo "Acesso inválido.";
}
?>
