<?php 
    class Exceptio extends Exception {
        public function printff($algumProblema) {
            throw new Exception($algumProblema);
        }
        public function getMensagemFormatada() {
            return json_encode([
                "tipoMsg" => "Erro",
                "msg" => $this->getMessage(),
            ]);
        }
        

    }    
    
    
    
    ?>