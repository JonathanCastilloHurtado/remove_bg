<?php 
$data = json_decode(file_get_contents('php://input'), true);

$base64string=($data['imagen']==""||$data['imagen']==null)?null:$data['imagen'];

file_put_contents('img.jpg', base64_decode($base64string));


$command = escapeshellcmd('python view.py');
$output = shell_exec($command);

if($output){
	$code=200;
	$definition="La imagen se proceso con exito."; 

	$path = './output_image.jpg';
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	$respuesta= base64_encode($data);
}
else{
    $code=400;
	$definition="No se ha podido procesar la imagen.";
	$respuesta=null;
} 

print_json($code, $definition, $respuesta);

function print_json($code, $definition, $respuesta)
{
    header("HTTP/1.1");
    header("Content-Type: application/json; charset=UTF-8");
    $array_resp['StatusCode'] = $code;
    $array_resp['StatusMessage'] = $definition;
    $array_resp['Response'] = $respuesta;

    echo json_encode($array_resp, JSON_PRETTY_PRINT);
}

 ?>
