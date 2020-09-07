<?php
	function sendsms($number,$senderid,$message,$con)
	{
		$data= array(
		"username" => strtolower($con[0]),
		"password" => strtolower($con[1]),
		"sender" => $senderid,
		"recipient" => $number,
		"message" => $message
		) ; //This contains data that you will send to the server.
		$data = http_build_query($data); //builds the post string ready for posting
		return do_post_request('https://api.smartsmssolutions.com/smsapi.php', $data);  //Sends the post, and returns the result from the server.
	}

  function do_post_request($url, $data, $optional_headers = null)
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
     return formatXmlString($response);
     
  }

//takes the XML output from the server and makes it into a readable xml file layout
//DO NOT EDIT unless you are sure of your changes
function formatXmlString($xml) 
{  
  
  // add marker linefeeds to aid the pretty-tokeniser (adds a linefeed between all tag-end boundaries)
  $xml = preg_replace('/(>)(<)(\/*)/', "$1\n$2$3", $xml);
  
  // now indent the tags
  $token      = strtok($xml, "\n");
  $result     = ''; // holds formatted version as it is built
  $pad        = 0; // initial indent
  $matches    = array(); // returns from preg_matches()
  
  // scan each line and adjust indent based on opening/closing tags
  while ($token !== false) : 
  
    // test for the various tag states
    
    // 1. open and closing tags on same line - no change
    if (preg_match('/.+<\/\w[^>]*>$/', $token, $matches)) : 
      $indent=0;
    // 2. closing tag - outdent now
    elseif (preg_match('/^<\/\w/', $token, $matches)) :
      $pad--;
    // 3. opening tag - don't pad this one, only subsequent tags
    elseif (preg_match('/^<\w[^>]*[^\/]>.*$/', $token, $matches)) :
      $indent=1;
    // 4. no indentation needed
    else :
      $indent = 0; 
    endif;
    
    // pad the line with the required number of leading spaces
    $line    = str_pad($token, strlen($token)+$pad, ' ', STR_PAD_LEFT);
    $result .= $line . "\n"; // add to the cumulative result, with linefeed
    $token   = strtok("\n"); // get the next token
    $pad    += $indent; // update the pad size for subsequent lines    
  endwhile; 
  
  return $result;
}

?>