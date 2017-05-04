<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/', function () use($app) {
	$cadena = file_get_contents('employees.json');
    $listEmp = json_decode($cadena); 

    echo '<table border="0">
            <tr>
                <td><h1>Lista de Empleados</h1></td>
            </tr>
          </table>';
    echo '<table border="1">
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Salario</th>
            </tr>
        ';
    foreach($listEmp as $emp){
        $id   = $emp->id;
        $name = $emp->name;   
        $email = $emp->email;
        $position = $emp->position;
        $salary = $emp->salary;
        echo '<tr>
                    <td><a href="detalle/'.$id.'">'.$name.'</a></td>
                    <td>'.$email.'</td>
                    <td>'.$position.'</td>
                    <td>'.$salary.'</td>
                  </tr>';
        echo "";
    }
    echo "</table>";
    echo '<form method="POST">
            <table border="0">
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><input type="text" name="email" placeholder="Ingrese email"/></td>
                    <td><input type="submit" value="Buscar"/></td>
                </tr>
            </table>
          </form>';
    echo '<p style="color:red;">URL para usar el servicio web por rango de salario: <b>/salario/salarioMin/salarioMax</b></p>';
});

$app->post('/', function(){
    $cadena = file_get_contents('employees.json');
    $listEmp = json_decode($cadena); 

    echo '<table border="0">
            <tr>
                <td><h1>Lista de Empleados</h1></td>
            </tr>
          </table>';
    echo '<table border="1">
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Salario</th>
            </tr>
        ';
    foreach($listEmp as $emp){
        $id   = $emp->id;
        $name = $emp->name;   
        $email = $emp->email;
        $position = $emp->position;
        $salary = $emp->salary;
        if($email == $_POST["email"]){
            echo '<tr>
                    <td><a href="detalle/'.$id.'">'.$name.'</a></td>
                    <td>'.$email.'</td>
                    <td>'.$position.'</td>
                    <td>'.$salary.'</td>
                  </tr>';
            echo "";
        }
    }
    echo "</table>";
    echo '<form method="POST">
            <table border="0">
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><input type="text" name="email" placeholder="Ingrese email"/></td>
                    <td><input type="submit" value="Buscar"/></td>
                </tr>
            </table>
          </form>';
    echo '<p style="color:red;">URL para usar el servicio web por rango de salario: <b>/salario/salarioMin/salarioMax</b></p>';
});

$app->get('/detalle/:id', function ($id) {
    $key = $id;
	$cadena = file_get_contents('employees.json');
    $listEmp = json_decode($cadena); 
    foreach($listEmp as $emp){
        $id   = $emp->id;
        $name = $emp->name;   
        $email = $emp->email;
        $phone = $emp->phone;
        $address = $emp->address;
        $position = $emp->position;
        $salary = $emp->salary;
        $skills = $emp->skills;

        if($id == $key){
            $strf = implode(', ', array_map(function($c) {
                return $c->skill;
            }, $skills));

            echo '<table border="0">
                    <tr>
                        <td><h3>Detalle de Empleado</h3></td>
                    </tr>
                  </table>';
            echo '<table border="1">
                    <tr><td><b>Nombre :</b></td><td>'.$name.'</td></tr>
                    <tr><td><b>Email :</b></td><td>'.$email.'</td></tr>
                    <tr><td><b>Telefono :</b></td><td>'.$phone.'</td></tr>
                    <tr><td><b>Dirección :</b></td><td>'.$address.'</td></tr>
                    <tr><td><b>Cargo :</b></td><td>'.$position.'</td></tr>
                    <tr><td><b>Salario :</b></td><td>'.$salary.'</td></tr>
                    <tr><td><b>Habilidades :</b></td><td>'.$strf.'</td></tr>
                  </table>';
            echo '<p style="color:red;">URL para usar el servicio web por rango de salario: <b>/salario/salarioMin/salarioMax</b></p>';
        }
    }
});

$app->get('/salario/:min/:max', function ($min,$max) {
    $minSal = $min;
    $maxSal = $max;
    $cadena = file_get_contents('employees.json');
    $listEmp = json_decode($cadena); 
	$xml = new SimpleXMLElement('<employees/>');
    foreach($listEmp as $emp){
        $id   = $emp->id;
        $name = $emp->name;   
        $email = $emp->email;
        $position = $emp->position;
        $salary = $emp->salary;
        
        $convertir = array("$", ",");
        $sueldo = str_replace($convertir, "", $salary);
     
        if($sueldo >= $minSal && $sueldo <= $maxSal){
            $empleado = $xml->addChild('employee');
            $empleado->addChild('id', $id);
            $empleado->addChild('name', $name);     
            $empleado->addChild('email', $email); 
            $empleado->addChild('position', $position); 
            $empleado->addChild('salary', $salary);       			 
        }
    }
    echo $xml->asXml();
});

$app->run();