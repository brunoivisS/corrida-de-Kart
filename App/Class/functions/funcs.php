<?php 

function tempoParaSegundos($tempo): int
{
    list($minutos, $segundos, $milissegundos) = explode(':', $tempo);
    return ($minutos * 60) + $segundos + ($milissegundos / 1000);
} 




?>