<?php

$access_token = 'bkyBuvWlx6OrzhNLnjS57Xb0uZqckIlyZBL1IA8+1+09Pcvp9XecL4/TbuRpMY4u0j10OI/m4FO5I1zz8veVpVUU9iTj9dVCDTOHmEjPb3zDKpX2VOGVs6080trN2cUHAwSfS6m8yvXpUiA3kAYtPAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

            // Build message to reply back
            if($text == "พี่นัทตี้")
            { 
                // $messages = [
                // 'type' => 'text',
                // 'text' => $text
                // ];
                $messages = [
                'type' => 'text',
                'text' => "มั่วรออะไรอยู่ ปรบมือสิ ปรบมือ!!!!"
                ];
            
                // Make a POST Request to Messaging API to reply to sender
                $url = 'https://api.line.me/v2/bot/message/reply';
                $data = [
                    'replyToken' => $replyToken,
                    'messages' => [$messages],
                ];
                $post = json_encode($data);
                $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                $result = curl_exec($ch);
                curl_close($ch);

                echo $result . "\r\n";
            }
			
		}
	}
}
echo "OK";

// echo "I am a bot naja";
?>