<?php
 class Kart {

     
     function AlldataKart($kart) {
        $arrayDados = []; 
        (array)$arquivo = file('public/'.$kart.'', FILE_IGNORE_NEW_LINES);
    
        foreach ($arquivo as $linha){

            $partes = preg_split('/\s+/', trim($linha));

            $hora = $partes[0];
            $codigoPiloto = $partes[1].' - '.$partes[3];
            $numeroVolta = (int)$partes[4];
            $tempoVolta = $partes[5];
            $mediaSpeed = $partes[6];


                $dados = [
                    "Hora"=>$hora,
                    "Piloto"=>$codigoPiloto,
                    "NumberoVolta"=>$numeroVolta,
                    "TempVolta"=>$tempoVolta,
                    "mediaVol"=>$mediaSpeed,
                ];

            $arrayDados[] = $dados;
        }
        return $arrayDados;
    }
    function GetBestLapPilt($dados) {
        $data = $dados;
        
        // Crie um array associativo para armazenar as melhores voltas de cada piloto
        $melhoresVoltas = array();
        // $piloto = array();
        foreach ($data as $item) {
            $piloto = $item['Piloto'];
            $tempoVolta = strtotime(str_replace('.', '', $item['TempVolta'])); // Converte tempo de volta para segundos
          
        
            // Verifique se já temos uma melhor volta para esse piloto
            if (isset($melhoresVoltas[$piloto])) {
                $melhorTempo = $melhoresVoltas[$piloto]['TempVolta'];
                
                if ($tempoVolta < $melhorTempo) {
                    // Atualize a melhor volta
                    $melhoresVoltas[$piloto] = $item;
                }
            } else {
                // Se o piloto ainda não tem uma melhor volta, adicione esta
                $melhoresVoltas[$piloto] = $item;
            }
        }
        var_dump($melhoresVoltas);
        foreach ($melhoresVoltas as $title) {
            
            echo("<h1>A melhor volta do ".$title['Piloto']." é ".$title['TempVolta'].".</h1>");
        }
    }

}
