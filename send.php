<?php
define('SERVER_API_KEY','AIzaSyBP1_rL5y0tDWdRp2qV_0RYLUF9MgplfyA');
$tokens = ['dbxFHi_LFoU:APA91bETK1ndhI_O-2-rMDfB9axHD-uHLzuWGRXV8F5XScGuRTy3gZ_FoO3jj9CR4v4LRTDPEDqnL82WIGDj9MLimDH04LtnLy1fpE06xHVSHRmQMSyVz1ZDSvV5Hopxo9EHrMUtaRH0'];
$header =[
'Authorization: key='.SERVER_API_KEY,
'Content-Type: Application/json'
];
$msg =[
'title' => 'Se acabó el semestre',
'body' => 'Espero hayas aprendido cosas nuevas en esta materia',
'icon' => './img/badpepe.png',
'img' => './img/badpepe.png',
];
$payload = array(
'registration_ids' => $tokens,
'data' => $msg
);
$curl = curl_init();

curl_setopt_array($curl, array(
 CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_CUSTOMREQUEST => "POST",
 CURLOPT_POSTFIELDS => json_encode( $payload ),
 CURLOPT_SSL_VERIFYHOST => 0,
 CURLOPT_SSL_VERIFYPEER => 0,
 CURLOPT_HTTPHEADER => $header
));
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
 echo "cURL Error #:" . $err;
} else {
 echo $response;
}
?>
