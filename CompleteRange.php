<?php

class CompleteRange
{
    public function build($arrEnteros) {
                
        sort($arrEnteros);
        
        $cantElem = count($arrEnteros);
        $numMin = $arrEnteros[0];
        $numMax = $arrEnteros[$cantElem-1];
        $arrNum = array();
        
        for ($i = $numMin; $i <= $numMax; $i++) {
            array_push ($arrNum, $i);
        }
        
        return $arrNum;
        
    }       

}

//PARAMETRO DE ENTRADA
$enteros = array(55, 58, 60);

//CONSTRUCTOR
$a = new CompleteRange();

//LLAMADA A FUNCION BUILD
$retorno = array();
$retorno = $a->build($enteros);

for ($i = 0; $i < count($retorno); $i++) {
    echo $retorno[$i]." ";
}

?>