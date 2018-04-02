<?php

    $apiKey = "sm4fe284a2546b446ea99419d8193db2bd"; 

    function sendSmsOneHop($source,$text,$senderId,$label,$mobileNumber)
    {
           global $apiKey; 
            //require 'http.php';
            $request = new HttpRequest();
            $request->setUrl('http://api.onehop.co/v1/sms/send/bulk');
            $request->setMethod(HTTP_METH_POST);
            $array = explode(',',$mobileNumber);
            foreach($array as $row){
              $data[] = array(
                "mobile_number"=> $row, 
                "sms_text" => $text,
                "sender_id" => $senderId,
                "label" => $label
              );
            }
            $json['sms_list'] = $data;
            $j = json_encode($json,true);
            $request->setBody($j);

            $request->setHeaders(array(
                'content-type' => 'application/json',
                'apikey' => $apiKey
            ));

            try {
            $response = $request->send();
            echo '<div class="alert alert-success">';
               echo $response->getBody();
            echo '</div>';
            } catch (HttpException $ex) {
              echo '<div class="alert alert-danger">';
                echo $ex;
              echo '</div>';
            }
    }


    function sendSmsOneHop_TEST($source,$text,$senderId,$label,$mobileNumber){
        global $apiKey;
        $array = explode(',',$mobileNumber);
        foreach($array as $row){
          $data[] = array(
            "mobile_number"=> $row,
            "sms_text" => $text,
            "sender_id" => $senderId,
            "label" => $label
          );
        }
        $json['sms_list'] = $data;
        $j = json_encode($json,true);
        print_r($j); 
        $headers = [
          "apiKey: ".$apiKey,
          "Content-Type: application/json" 
        ];
        # Create a connection
        $url = 'http://api.onehop.co/v1/sms/send/bulk';
        $ch = curl_init($url);
        # Form data string
        //$postString = http_build_query($j, '', '&'); 
        # Setting our options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $j);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        # Get the response
        $response = curl_exec($ch);
        curl_close($ch);
        echo '<div class="alert alert-success">';
        print_r($response);
        echo '</div>';
    }



    function sendSmsTextGoTo($username,$password,$to,$text)
    {
          $url = 'https://textgoto.com/api/jsonapi.aspx';
          // create an array in the following format
          $data_array =  array("header" => array(
             "-uid"    => $username,
             "-pwd"    => $password,
             "-action" =>"SEND_MSISDN"
             ),
             "body" => array(
               "msisdn"=> explode(',',$to),
               "msg"=> $text,
               "orig"=> "[ORIGINATOR]"
               )
             );


          $data = array("campaign" => $data_array);
          // And then encoded as a json string
          $data_string = json_encode($data);
          $ch=curl_init($url);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Content-Length: ' . strlen($data_string)));
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_POST, curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string));
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          // Required for SSL
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          $result = curl_exec($ch);
          curl_close($ch);
          // print out response
          echo '<div class="alert alert-danger">';
          print_r($result);
          echo '</div>';
    }

    function sendSmsIntellisms($username,$password,$to,$text,$senderId){
        include 'IntelliSMS_PHPSDK/SendScripts/IntelliSMS.php';
        //Required php.ini settings:
        // allow_url_fopen = On
        // track_errors = On

        $objIntelliSMS = new IntelliSMS();
        $objIntelliSMS->Username = $username;
        $objIntelliSMS->Password = $password;
        $result= $objIntelliSMS->SendMessage ($to,$text,$senderId);
        echo '<div class="alert alert-danger">';
        print_r($result);
        echo '</div>';
    } 

    function sendSmsNextMo($apiKey,$apiSecret,$to,$from,$text){
          require 'vendor/autoload.php';
          $basic  = new \Nexmo\Client\Credentials\Basic($apiKey,$apiSecret); 
          $client = new \Nexmo\Client($basic);
          $array = explode(',',$to);
          foreach($array as $row){ 
              $message = $client->message()->send([
                'to' => $row,  
                'from' => $from, 
                'text' => $text 
            ]);  
          }
        echo '<div class="alert alert-success">';
        print_r($message);     
        echo '</div>'; 
    }   

    function test($source,$text,$senderId,$label,$mobileNumber)
    {
           global $apiKey;
            $array = explode(',',$mobileNumber);
            foreach($array as $row){
              $data[] = array(
                "mobile_number"=> $row,
                "sms_text" => $text,
                "sender_id" => $senderId,
                "label" => $label
              );
            }
            $json['sms_list'] = $data;
            $j = json_encode($json,true);


            $cmd = 'curl -X POST -H "apiKey: '.$apiKey.'" \
            -H "Content-Type: application/x-www-form-urlencoded" \
            -d
            "mobile_number='.$row.'&sms_text='.$text.'&label='.$label.'&sender_id='.$senderId.'"
            "http://api.onehop.co/v1/sms/send/bulk"';
            echo $cmd;
            exec($cmd,$result);
            print_r($result);
        }






?>
