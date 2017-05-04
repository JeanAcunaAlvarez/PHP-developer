<?php

class ChangeString
{
    public function build($texto) {
        
        $min =str_split("abcdefghijklmnñopqrstuvwxyz");
        $may =str_split("ABCDEFGHIJKLMNÑOPQRSTUVWXYZ");        
        $arrTxt = str_split($texto);
        $arrRes = array();
        $result = "";
        
        foreach ($arrTxt as $caracter){
            $cont = 0;
            $encontrado = 0;
            foreach ($min as $minCar){
                if ($caracter == $minCar){
                    if ($cont==27){
                        array_push ($arrRes, $min[0]);
                        $encontrado=1;
                    }else{
                        array_push ($arrRes, $min[$cont+1]);
                        $encontrado=1;
                    }
                }
                $cont++;
            }
            
            if ($encontrado==0){
                $cont = 0;
                foreach ($may as $mayCar){
                    if ($caracter == $mayCar){
                        if ($cont==27){
                            array_push ($arrRes, $may[0]);
                            $encontrado=1;
                        }else{
                            array_push ($arrRes, $may[$cont+1]);
                            $encontrado=1;
                        }
                    }
                    $cont++;
                }   
            }
            if ($encontrado==0){
                array_push ($arrRes, $caracter);
            }
        }
        
        $result = implode($arrRes);
        
        return $result;
        
    }       

}

//PARAMETRO DE ENTRADA
$text = "**Casa 52Z";

//CONSTRUCTOR
$a = new ChangeString();

//LLAMADA A FUNCION BUILD
echo $a->build($text);

?>