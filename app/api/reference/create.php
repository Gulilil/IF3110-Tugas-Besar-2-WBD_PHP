<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');

$xml = file_get_contents('php://input');
$data = json_decode($xml, true);

if (isset($data['id'])){
  $id = $data['id'];
  $request_param = '<?xml version="1.0" encoding="utf-8"?>
  <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
      <getAllSubscriptionRequestBySubscriber xmlns="http://service.binotify.com/">
          <subscriber>'. $id . '</subscriber>
      </getAllSubscriptionRequestBySubscriber>
    </soap:Body>
  </soap:Envelope>
    ';

    $headers = array(
      "Content-Type: text/xml; charset=\"utf-8\"",
      'Content-Length: ' .strlen($request_param),
      'X-API-Key: ' . SOAP_API_KEY
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request_param);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

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
      $response1 = str_replace('<?xml version=\'1.0\' encoding=\'UTF-8\'?>
      <S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/">
          <S:Body>
              <ns2:insertReferenceResponse xmlns:ns2="http://service.wbd_soap.com/">
                  <return>',"",$response);
      $msg = str_replace('</return>
              </ns2:insertReferenceResponse>
          </S:Body>
      </S:Envelope>',"",$response1);
  
      http_response_code(200);
      echo json_encode(array(
        'status' => 'success',
        'message' => $msg,
      ));
    }

}
?>