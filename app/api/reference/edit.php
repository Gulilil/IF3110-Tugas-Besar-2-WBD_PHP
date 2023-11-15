<?php 

require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/setup/setup.php');

$xml = file_get_contents('php://input');
$data = json_decode($xml, true);

if (isset($data['type'])){
  $type = $data['type'];

  // To Link
  if ($type == "link"){
    $fid = $data['forum_id'];
    $aid = $data['anime_id'];
    $request_param = '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
        <updateReferenceEstablishLink xmlns="http://service.wbd_soap.com/">
            <arg0 xmlns="">'. $fid . '</arg0>
            <arg1 xmlns="">'. $aid . '</arg1>
            </updateReferenceEstablishLink>
        </Body>
    </Envelope>
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
                <ns2:updateReferenceEstablishLinkResponse xmlns:ns2="http://service.wbd_soap.com/">
                    <return>',"",$response);
        $msg = str_replace('</return>
                </ns2:updateReferenceEstablishLinkResponse>
            </S:Body>
        </S:Envelope>',"",$response1);
    
        http_response_code(200);
        echo json_encode(array(
          'status' => 'success',
          'message' => $msg,
        ));
      }
  }
  // To Unlink
  else if ($type == "unlink"){
    $fid = $data['forum_id'];
    $aid = $data['anime_id'];
    $request_param = '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
        <updateReferenceUnlink xmlns="http://service.wbd_soap.com/">
            <arg0 xmlns="">'. $fid . '</arg0>
            <arg1 xmlns="">'. $aid . '</arg1>
            </updateReferenceUnlink>
        </Body>
    </Envelope>
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
                <ns2:updateReferenceUnlinkResponse xmlns:ns2="http://service.wbd_soap.com/">
                    <return>',"",$response);
        $msg = str_replace('</return>
                </ns2:updateReferenceUnlinkResponse>
            </S:Body>
        </S:Envelope>',"",$response1);
    
        http_response_code(200);
        echo json_encode(array(
          'status' => 'success',
          'message' => $msg,
        ));
      }
  } 
  // To Change Point
  else if ($type == "point"){
    $fid = $data['forum_id'];
    $aid = $data['anime_id'];
    $point = $data['point'];
    $request_param = '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
        <updateReferenceChangePoint xmlns="http://service.wbd_soap.com/">
            <arg0 xmlns="">'. $fid . '</arg0>
            <arg1 xmlns="">'. $aid . '</arg1>
            <arg2 xmlns="">'. $point .'</arg2>
            </updateReferenceChangePoint>
        </Body>
    </Envelope>
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
                <ns2:updateReferenceChangePointResponse xmlns:ns2="http://service.wbd_soap.com/">
                    <return>',"",$response);
        $msg = str_replace('</return>
                </ns2:updateReferenceChangePointResponse>
            </S:Body>
        </S:Envelope>',"",$response1);
    
        http_response_code(200);
        echo json_encode(array(
          'status' => 'success',
          'message' => $msg,
        ));
      }
  }
}
?>