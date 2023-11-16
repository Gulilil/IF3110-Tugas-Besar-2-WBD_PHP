<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');

$xml = file_get_contents('php://input');
$data = json_decode($xml, true);

if (isset($data['id'])){
  $id = $data['id'];  
  $request_param = '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
      <giveReferenceDataWithAnimeAccountID xmlns="http://service.wbd_soap.com/">
          <arg0 xmlns="">'.$id.'</arg0>
          </giveReferenceDataWithAnimeAccountID>
      </Body>
  </Envelope>
  ';

  $headers = array(
    "Content-Type: text/xml; charset=\"utf-8\"",
    'Content-Length: ' .strlen($request_param),
    'X-API-Key: ' . SOAP_API_KEY
  );

  $ch = curl_init(SOAP_URL);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $request_param);
  curl_setopt($ch, CURLOPT_URL, SOAP_URL);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $response = curl_exec($ch);
  curl_close($ch);
  if ($response === FALSE) {
    printf("CURL error (#%d): %s<br>\n", curl_errno($ch),
    htmlspecialchars(curl_error($ch)));
    echo json_encode(array(
      'status' => 'error',
      'message' => "Connection Failed ",
    ));
  }
  else {
    $response1 = str_replace('<?xml version=\'1.0\' encoding=\'UTF-8\'?><S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/"><S:Body><ns2:giveReferenceDataWithAnimeAccountIDResponse xmlns:ns2="http://service.wbd_soap.com/"><return>',"",$response);
    $msg = str_replace('</return></ns2:giveReferenceDataWithAnimeAccountIDResponse></S:Body></S:Envelope>',"",$response1);
  
    $obj = json_decode($msg);
    $data = $obj->data;
    http_response_code(200);
    echo json_encode(array(
      'status' => 'success',
      'message' => $data,
    ));
  }
  }
?>