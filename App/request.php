<?php
require_once(__DIR__.'/Class/Kart/Kart.class.php');

$action = $_REQUEST['acoes'];
// var_dump($_REQUEST);
switch ($action) {
           case 'AlldataKart':
                $logContent = file_get_contents($_FILES['logFile']['tmp_name']);
                $ks = new Kart();
                $result = $ks->AlldataKart($logContent);
                // $ks->setArrayWithData($result);
                // $get = $ks->getArrayWithData();  
                //  $es = json_encode($get);
                echo $result;
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
