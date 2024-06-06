<?php
// Datos
$token = 'apis-token-6887.vAxWue6yvl8XB1vkouBDIMfm6PbvGIrB';
$ruc = $_POST["ruc"];

// Iniciar llamada a API
$curl = curl_init();

// Buscar ruc sunat
curl_setopt_array($curl, array(
// para usar la versión 2
//CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $ruc,
// para usar la versión 1
 CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: http://apis.net.pe/api-ruc',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo 'Error del scrapper' . curl_error($curl);
    exit;
}

curl_close($curl);
// Datos de empresas según padron reducido
echo $response;