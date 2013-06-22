<?php
# add image part to a kooaba multipart request
function image_part($boundary, $attr_name, $file_name, $data) {
  $str  = "--" . $boundary . "\r\n";
  $str .= 'Content-Disposition: form-data; name="'. $attr_name .'"; filename="' . $file_name . '"' . "\r\n";
  $str .= 'Content-Transfer-Encoding: binary' ."\r\n";
  $str .= 'Content-Type: image/jpeg' . "\r\n\r\n";
  $str .= $data . "\r\n";
  return $str;
}

# add text part to a kooaba multipart request
function text_part($boundary, $attr_name, $data) {
  $str = "--" . $boundary . "\r\n";
  $str .= 'Content-Disposition: form-data; name="'. $attr_name .'"'."\r\n\r\n";
  $str .= $data . "\r\n";
  return $str;
}

$happy = false;
$sad = false;

# get the image
$photo = $_FILES["image"];

$photo_bytes = file_get_contents($photo["tmp_name"]);

# do any necessary processing

# hit the API with curl
# curl -X POST -F image=@glass-close.jpg
#  -H 'Authorization: Token WE27xAaZUCoD7R2dDENPeGdyzploQBKVwRM6Qkee'
#  -H 'Accept: application/json' https://query-api.kooaba.com/v4/query

$boundary = uniqid();

# Construct the body of the request
$body  = image_part($boundary, "image", "query_image.jpg", $photo_bytes);
$body .= "--" . $boundary . "--\r\n";

$context = stream_context_create(array(
  'http' => array(
    'method' => 'POST',
    'header' => 'Content-type: multipart/form-data; boundary='.$boundary."\r\n" .
    'Authorization: Token WE27xAaZUCoD7R2dDENPeGdyzploQBKVwRM6Qkee',
    'content' => $body
  )
));

$result = file_get_contents("https://query-api.kooaba.com/v4/query", false, $context);

echo "Result: ", $result;
# parse response

# render the happy / sad / angry cow page
if($happy) {
  echo "happy cow!";
} else if ($sad) {
  echo "Sad cow!";
} else {
  echo "unknown cow!";
}

# Render detailed attributes
?>
<ul id="details">
  <li>Attribute 1: value</li>
  <li>Attribute 2: value</li>
  <li>Attribute 3: value</li>
</ul>