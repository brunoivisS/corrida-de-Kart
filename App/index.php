<!DOCTYPE html>
<html>
<head>
    <title>Corrida de Kart</title>
</head>
<body>
    <h1>Corrida de Kart</h1>
    <p>Remova a pimeira linha do seu arquivo(caso tenha dados irregulares)</p>
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="logFile" accept=".log">
        <input type="button" id="uploadButton" value="Enviar Arquivo">
    </form>

    <div id="result">
        <h2>Resultado:</h2>
        <span id="error"></span>
        <span id="Postions"></span>
        <span id="resultText"></span>
        <prev id="BestLapRace"></prev>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="index.js"></script>
</body>
</html>
