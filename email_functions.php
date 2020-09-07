<?php
	function sendemail($email,$senderid,$from,$subject,$message,$con)
	{
		$data= array(
		"Type"=> "sendparam", 
		"username" => $con[0],
		"password" => $con[1],
		"live" => "true",
		"senderid" => $senderid,
		"to" => $email,
		"from" => $from,
		"subject" => $subject,
		"message" => $message
		) ; //This contains data that you will send to the server.
		$data = http_build_query($data); //builds the post string ready for posting
		return do_post_email_request('http://www.digitaldreamsng.com/email/process_email2.php', $data);  //Sends the post, and returns the result from the server.
	}

  function do_post_email_request($url, $data, $optional_headers = null)
  {
     $params = array('http' => array(
                  'method' => 'POST',
                  'content' => $data
               ));
     if ($optional_headers !== null) {
        $params['http']['header'] = $optional_headers;
     }
     $ctx = stream_context_create($params);
     $fp = @fopen($url, 'rb', false, $ctx);
     if (!$fp) {
        return "#Error : Problem with internet connection";
     }
     $response = @stream_get_contents($fp);
     if ($response === false) {
       return "#Error : Problem reading data from online message portal";
     }
     $response;
     return $response;
     
  }
?>