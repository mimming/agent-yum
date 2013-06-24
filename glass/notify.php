<?php
/*
 * Copyright (C) 2013  Agent Yum - http://agentyum.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
// Author: Jenny Murphy - http://google.com/+JennyMurphy


// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] != "POST") {
  header("HTTP/1.0 405 Method not supported");
  echo("Method not supported");
  exit();
}


// In the child process (hopefully). Do the processing.
require_once 'config.php';
require_once 'mirror-client.php';
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_MirrorService.php';
require_once 'util.php';

// Parse the request body
$request_bytes = @file_get_contents('php://input');

file_put_contents("/tmp/notify", $request_bytes);
$request = json_decode($request_bytes, true);

// A notification has come in. If there's an attached photo, bounce it back
// to the user
$user_id = $request['userToken'];

$access_token = get_credentials($user_id);

$client = get_google_api_client();
$client->setAccessToken($access_token);

// A glass service for interacting with the Mirror API
$mirror_service = new Google_MirrorService($client);

switch ($request['collection']) {
  case 'timeline':
    // Verify that it's a share
    foreach ($request['userActions'] as $i => $user_action) {
      if ($user_action['type'] == 'SHARE') {

        $timeline_item_id = $request['itemId'];

        $timeline_item = $mirror_service->timeline->get($timeline_item_id);

        foreach ($timeline_item->getAttachments() as $j => $attachment) {
          $attachid = $attachment->getId();

          $attachment = $mirror_service->timeline_attachments->get($timeline_item_id, $attachid);
          $bytes = download_attachment($timeline_item_id, $attachment);

          require_once("functions.php");


          # setup config variables
          $query_key = "WE27xAaZUCoD7R2dDENPeGdyzploQBKVwRM6Qkee";
          $url = "https://query-api.kooaba.com/v4/query";

          # Image to query with
          $file_name = "query_image.jpg";

          # Define boundary for multipart message
          $boundary = uniqid();

          # Construct the body of the request
          $body = image_part($boundary, "image", $file_name, $bytes);
          $body .= "--" . $boundary . "--\r\n";

          $context = stream_context_create(array(
            'http' => array(
              'method' => 'POST',
              'header' => 'Content-type: multipart/form-data; boundary=' . $boundary . "\r\n" .
              'Authorization: Token ' . $query_key,
              'content' => $body
            )
          ));

          $result = file_get_contents($url, false, $context);

          $echo_timeline_item = new Google_TimelineItem();
          $echo_timeline_item->setNotification(new google_NotificationConfig(array("level" => "DEFAULT")));


          echo $result;

          $parsed_result = json_decode($result);
          if ($parsed_result->results && sizeof($parsed_result->results) > 0) {
            $name = $parsed_result->results[0]->title;


            // if we have a result
            $score = $parsed_result->results[0]->score;
            //echo "score $score<br/>";

            $metadata = $parsed_result->results[0]->metadata;

            $decision = $metadata->decision;

            $figureurl = "http://agentyum.com/images/confused-cow.png";
            if ($decision == "happy") {
              $figureUrl = "http://agentyum.com/images/happy-cow.png";
            } else if ($decision = "sad") {
              $figureUrl = "http://agentyum.com/images/sick-cow.png";
            }
            $timeline_html = "<article><figure><div style='margin:25px;'><img src='$figureUrl'  style='width:215px'/><p class='text-auto-size'>$name</p></div></figure>";

            $articleHtml = "<section>";
            # Render detailed attributes
            foreach ($metadata as $key => $value) {
              if ($key != "decision") {
                if ($value == 1) {
                  $articleHtml .= "<div id='details' style='background-color: rgb(20,108,33);margin: 2px;border-radius: 4px;padding:7px'>$key</div>";
                } else {
                  $fixed_key = preg_replace("/No/", "", $key);
                  $fixed_key = preg_replace("/no/", "", $fixed_key);
                  $fixed_key = preg_replace("/Not/", "", $fixed_key);
                  $fixed_key = preg_replace("/not/", "", $fixed_key);
                  $fixed_key = preg_replace("/Free/", "", $fixed_key);
                  $fixed_key = preg_replace("/free/", "", $fixed_key);
                  $articleHtml .= "<div id='details' style='background-color: rgb(141,6,0);margin: 2px;border-radius: 4px;padding:7px'>$fixed_key</div>";
                }
              }
            }
            $articleHtml .= "</section></article>";

            $timeline_html .= $articleHtml;

            echo $timeline_html;
            $echo_timeline_item->setHtml($timeline_html);

            insert_timeline_item($mirror_service, $echo_timeline_item, null, null);

          }
          break;
        }
      }
    }
    break;

  case
  'locations':
    $location_id = $request['itemId'];
    $location = $mirror_service->locations->get($location_id);
    // Insert a new timeline card, with a copy of that photo attached
    $loc_timeline_item = new Google_TimelineItem();
    $loc_timeline_item->setText("You are at " . $location->getLatitude() . " by " .
    $location->getLongitude());

    insert_timeline_item($mirror_service, $loc_timeline_item, null, null);
    break;
  default:
    error_log("I don't know how to process this notification: $request");
}

