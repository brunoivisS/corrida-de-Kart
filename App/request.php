<?php
require_once(__DIR__.'/Class/Kart/Kart.class.php');

$action = $_REQUEST['acoes'];
// var_dump($_REQUEST);
switch ($action) {
           case 'AlldataKart':
                try {
                    $data = $_FILES['logFile']['tmp_name'];
                    if(empty($data)){
                       throw new Exceptio("Voce precisa seleciona um arquivo.");
                    }
                    $logContent = file_get_contents($data);
                    $ks = new Kart();
                    $result = $ks->AlldataKart($logContent);
                    // $ks->setArrayWithData($result);
                    // $get = $ks->getArrayWithData();  
                    //  $es = json_encode($get);
                    echo $result;    
                } catch (Exceptio $e) {
                    echo $e->getMensagemFormatada();
                }
                break;
            case 'GetBestLapPilt':
                $ks = new Kart();
                $result = json_decode($_GET['response'],true);   

                $BestLapPilot = $ks->GetBestLapPilt($result);
                echo $BestLapPilot;
                break;
            case 'GetPositionPilot':
                $ks = new Kart();
                $result = json_decode($_GET['response'],true);   

                $GetPositionPilot = $ks->GetPositionPilot($result);
                echo $GetPositionPilot;
                break;
            case 'returnTheBestLabRace':
                $ks = new Kart();
                $result = json_decode($_GET['response'],true);   

                $GetBestLapRace = $ks->returnTheBestLabRace($result);
                echo $GetBestLapRace;
                break;
            
            default:
                echo "Ação desconhecida";
        }

?>
