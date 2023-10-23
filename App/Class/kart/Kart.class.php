<?php
    require_once(__DIR__.'/../../Class/functions/funcs.php');
 class Kart {

    private $arrayWithData = null;


    public function getArrayWithData() {
        return $this->arrayWithData;
    }

    public function setArrayWithData($data) {
        $this->arrayWithData = $data;
    }

     //essa function é resposavel por ler o arquivo
     function AlldataKart($kart) {
        $funs = new Funcs();
        $lines = explode("\n", $kart);
        // (array)$arquivo = $kart;
       $validaçaodosDados =  $funs->validacaodeLinha($lines);
       if(!$validaçaodosDados){
            echo "Parece que seu dados estao com padroes difirente.";
       } else{
        $arrayDados = [];
    
        foreach ($lines as $linha){

            $partes = preg_split('/\s+/', trim($linha));

            $hora = $partes[0];
            $codigoPiloto = $partes[1].' - '.$partes[3];
            $numeroVolta = (int)$partes[4];
            $tempoVolta = $partes[5];
            $mediaSpeed = $partes[6];


                $dados = [
                    "Hora"=>$hora,
                    "PilotoName"=>$partes[3],
                    "Piloto"=>$codigoPiloto,
                    "NumberoVolta"=>$numeroVolta,
                    "TempVolta"=>$tempoVolta,
                    "mediaVol"=>$mediaSpeed,
                ];

                $arrayDados[] = $dados;
        }
        return json_encode($arrayDados);
       }
        // var_dump($lines);
        // var_dump($kart);;
        // fazer o kart vira um array despois coloca no kart e vai tia os espaço dentro do 
        
    }
    //essa function serve para pega a melhor volta de cada piloto
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
        // var_dump($melhoresVoltas['038 - F.MASSA']);
        foreach ($melhoresVoltas as $title) {
            
            echo("<h1>A melhor volta do ".$title['Piloto']." é ".$title['TempVolta'].".</h1>");
        }
    }

    //aqui pega o melhor volta da corrida
    function returnTheBestLabRace($dados) {
        $corrida = $dados;
        $melhorVolta = null;
       
        $melhorTempo = PHP_INT_MAX; // Inicializa com um valor alto
        $funcs = new Funcs();
        foreach ($corrida as $volta) {
            $tempoVolta = $volta["TempVolta"];
            // print_r($volta['TempVolta']);
            if ($tempoVolta < $melhorTempo) {
                $melhorTempo = $tempoVolta;
                $melhorVolta = $volta;
            }
        }
        echo "<h1>Melhor volta da corrida:\n";
        echo "Piloto: " . $melhorVolta["Piloto"] . ",\n";
        echo "Tempo da volta: " . $melhorVolta["TempVolta"] . ",\n";
        echo "Numero da volta: " . $melhorVolta["NumberoVolta"] . ",\n";
        echo "Hora da volta: " . $melhorVolta["Hora"] . "</h1><br>";
    }
    //essa function serve para pega as posições dos ganhadores
    function GetPositionPilot($dados) {
        $data = $dados;
        $funcs = new Funcs();
        // Crie um array associativo para armazenar as melhores voltas de cada piloto
        $melhoresVoltas = array();
        // $piloto = array();
        foreach ($data as $item) {
            //definido nome do piloto
            $piloto = $item['Piloto'];
             // Converte tempo de volta para segundos
            $tempoVolta = strtotime(str_replace('.', '', $item['TempVolta']));
            //salvando a volta do piloto para compara com o valor max da labs
            $voltaNumber = $item['NumberoVolta'];
            $valorMaxdeLabs = $funcs->valorMaxdaCorrida($dados);
            
        if($voltaNumber === $valorMaxdeLabs){
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

        }
        $arraywithTotalTmp = [];

     
        (array)$vas = Kart::GetTempPilots($data);
        foreach ($melhoresVoltas as $title) {
        
               $tempototal = $vas[$title['PilotoName']];
            $dados = [
                "Piloto"=>$title['Piloto'],
                "NumberoVolta"=>$title['NumberoVolta'],
                "TempToltal"=>$tempototal,
                "TempLapFinal"=>$title['TempVolta']
            ];
            
            $arraywithTotalTmp[] = $dados;
        }
        usort($arraywithTotalTmp, function ($a, $b) {
            $tempoA = $a["TempToltal"];
            $tempoB = $b["TempToltal"];
            return strcmp($tempoA, $tempoB);
        });
        //essa vareivel serve para saber que ganhou a corrida e para ver o tempo depois que o vencedor ganha
        $PilotoWin = $arraywithTotalTmp[0];


        $posicao = 1;
        echo "Posição de chegada: <br>\n";
        foreach ($arraywithTotalTmp as $title) {
            
            echo $posicao . ". " . $title['Piloto'] . " - ".$title['NumberoVolta']." -  ".$title['TempToltal']." <br>\n";
            $posicao++;
        }
        
    }
    //essa function serve para pega os tempo total da corrida e retorna na variavel 
    //ela foi feita para exibir o tmp total de cada corredor.
    function GetTempPilots(array $data){
        $arraywithTmp = [];
        $temposPorPiloto = array();
        $funcs = new Funcs();
        
        foreach ($data as $registro) {
            $piloto = $registro["PilotoName"];
            $tempoVolta = $registro["TempVolta"];
            
            if (!isset($temposPorPiloto[$piloto])) {
                $temposPorPiloto[$piloto] = array();
            }
            
            
            
            $temposPorPiloto[$piloto][] = $tempoVolta;
            $arraywithTmp[$piloto] = $funcs->somaTempos($temposPorPiloto[$piloto]);
        }
        
        return $arraywithTmp;
            
      }

}
