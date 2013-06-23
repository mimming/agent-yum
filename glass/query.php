<?php

require_once("functions.php");

# setup config variables
$query_key = "WE27xAaZUCoD7R2dDENPeGdyzploQBKVwRM6Qkee";
$url = "https://query-api.kooaba.com/v4/query";

# Image to query with
$file_path = "../images/query_image.jpg";
$file_name = "query_image.jpg";

if (file_exists($file_path)) {
  $img = file_get_contents($file_path);
} else {
  die($file_path . ": File does not exist");
}

# Define boundary for multipart message
$boundary = uniqid();

# Construct the body of the request
$body  = image_part($boundary, "image", $file_name, $img);
$body .= "--" . $boundary . "--\r\n";

$context = stream_context_create(array(
              'http' => array(
                   'method' => 'POST',
                   'header' => 'Content-type: multipart/form-data; boundary='.$boundary."\r\n" .
                               'Authorization: Token ' . $query_key,
                   'content' => $body
                   )
              ));

$result = file_get_contents($url, false, $context);

echo "Result: ", $result;

?>

