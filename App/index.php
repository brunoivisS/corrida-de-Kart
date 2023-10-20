<?php 
require_once(__DIR__.'/Class/Kart/Kart.class.php');
//  namespace \



    // function tempoParaSeguddoss($tempo): int
    // {
    //     list($minutos, $segundos, $milissegundos) = explode(':', $tempo);
    //     return ($minutos * 60) + $segundos + ($milissegundos / 1000);
    // }
    


    //{ ["Hora"]=> string(12) "23:49:08.277" ["Piloto"]=> string(13) "038 - F.MASSA" ["NumberoVolta"]=> int(1) ["TempVolta"]=> string(8) "1:02.852" ["mediaVol"]=> string(6) "44,275" } 
    //aqui eu envio o arquivo para a function que coleta os dados do arquivo
    //e transforma em array todas as linhas
    // ao executa: var_dump($result); verá o resultado do que seria uma array com todos os dados que precisamos.
    // use var_dump($result['Piloto']); para seleciona apenas um objeto
    $input = 'kart.log';
    $ks = new Kart();
    $result= $ks->AlldataKart($input);
    $ks->GetBestLapPilt($result);

    //PRIMEIRA TASK FEITA 
    //pega os dados e obtente a melhor volta de cada piloto
    
