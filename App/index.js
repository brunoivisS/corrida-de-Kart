$(document).ready(function() {
    $('#uploadButton').click(function() {
        var formData = new FormData($('#uploadForm')[0]);
        formData.append('acoes', 'AlldataKart'); // Adicione a ação ao FormData

        $.ajax({
            url: 'request.php',
            type: 'POST', // Altere para POST
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                response = JSON.parse(response)
                if (response.tipoMsg === "Erro") {
                    $('#error').text(response.msg);
                } else {
                    response = JSON.stringify(response)

                    $.ajax({
                        url: 'request.php',
                        type: 'GET',
                        data: {
                            'acoes': 'GetBestLapPilt',
                            'response': response,
                        },
                        success: function(response) {
                            $('#resultText').html(response);
                            console.log('nice');
                        }
                    });
                    
    
                    $.ajax({
                        url: 'request.php',
                        type: 'GET',
                        data: {
                            'acoes': 'GetPositionPilot',
                            'response': response,
                        },
                        success: function(response) {
                            $('#Postions').html(response);
                            console.log('nice');
                        }
                    });
    
                    $.ajax({
                        url: 'request.php',
                        type: 'GET',
                        data: {
                            'acoes': 'returnTheBestLabRace',
                            'response': response,
                        },
                        success: function(response) {
                            $('#BestLapRace').html(response);
                            console.log('flw');
                        }
                    });
    
                }
                // Inicia uma segunda chamada AJAX (método GET) após o sucesso da primeira chamada
                // Aqui retorna h1 com os melhores dados de cada piloto da corrida inteira
                
                 

            },
            error: function(){
                $('#error').text("Não foi possivel tratar os dados");
            }
        });
    });
});