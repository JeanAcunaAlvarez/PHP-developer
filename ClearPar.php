<?php

class ClearPar
{
    public function build($texto) {
        
        $arrTxt = str_split($texto);
        $cantElem = count($arrTxt);
        $cont = 0;
        $antChar = "";
        $result = "";
        
        foreach ($arrTxt as $caracter){
            $cont++;
            if($antChar == ""){
                if($caracter == "("){
                    $result = $result.$caracter; 
                }
            }else{
                if($antChar == "(" && $caracter == ")"){
                    $result = $result.$caracter;
                }else{
                    if($antChar == ")" && $caracter == "(" && $cont < $cantElem){
                        $result = $result.$caracter;
                    }
                }
            }
            $antChar = $caracter;
        }
        
        return $result;
        
    }       

}

//PARAMETRO DE ENTRADA
$text = "((()";

//CONSTRUCTOR
$a = new ClearPar();

//LLAMADA A FUNCION BUILD
echo $a->build($text);

?>