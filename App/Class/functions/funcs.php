<?php 
  class Funcs{
    //esse fezer para soma toda as tempo de cada volta e retorna uma tempo total da corrida.
    function somaTempos($tempos) {
        $totalMin = 0;
        $totalSeg = 0;
        $totalMili = 0;
    
        foreach ($tempos as $tempo) {
            list($min, $seg, $mili) = preg_split('/[:.]/', $tempo);
            $totalMin += $min;
            $totalSeg += $seg;
            $totalMili += $mili;
        }
    
        // Ajusta os valores se necessário
        $totalSeg += floor($totalMili / 1000);
        $totalMili %= 1000;
        $totalMin += floor($totalSeg / 60);
        $totalSeg %= 60;
    
        return sprintf('%d:%02d.%03d', $totalMin, $totalSeg, $totalMili);
    }

    //essa function serve para sabe qual foi o ultima volta da corrida inteira
    function valorMaxdaCorrida(array $dados){
        $numeroVoltaMaisAlto = 0;

        foreach ($dados as $item) {
            if ($item["NumberoVolta"] > $numeroVoltaMaisAlto) {
                $numeroVoltaMaisAlto = $item["NumberoVolta"];
            }
        }
        
        return $numeroVoltaMaisAlto;
    }
    //essa function retorna um bool true se as linhas estiverem corretas com o padrao desejado
    //caso o arquivo esteja com outro padrao ele não convertido para um array.
    function validacaodeLinha($linhas) {
        $padrao = '/^\d{2}:\d{2}:\d{2}\.\d{3}\s+\d{3}\s–\s[A-Z]+\.[A-Z]+\s\d+\s\d{1,2}:\d{2}\.\d{3}\s\d+(\,\d+)?$/';
        
        foreach ($linhas as $linha) {
            $linha = rtrim($linha);
            if (!preg_match($padrao, $linha)) {
                return false; // Return false immediately if an invalid line is found
            }
        }
        
        return true; // Return true only if all lines match the pattern
    }
    


 }


?>