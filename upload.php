<?php
/*
Copyright (C) 2013  Agent Yum - http://agentyum.com

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.

 Authors:
 - Jenny Murphy - http://mimming.com
 - Jennifer Wang - http://jewang.net
 - Matt Abdou - http://mattabdou.com
 - Winona Tong - http://winonatong.com
*/ ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet"
			href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css"/>
		<script
			src="http://code.jquery.com/jquery-1.7.1.min.js"></script>			
		<script
			src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
		</script>
		<script src="js.js"></script>
		<link rel="stylesheet" href="style.css" type="text/css">
		<link rel="icon" type="image/png" href="/favicon.png" />
	</head> 
						
	<body> 

<div id="home" data-theme="a" data-role="page">
	<div data-role="header">
		<h1>Agent Yum</h1>
	</div><!-- /header -->

	<div data-role="content">
<div style="text-align:center">
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
//print_r($photo);

$photo_bytes = file_get_contents($photo["tmp_name"]);

# do any necessary processing - crop? scale?

# hit the API with curl
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
//print_r($context);

$result = file_get_contents("https://query-api.kooaba.com/v4/query", false, $context);

$parsed_result = json_decode($result);
if($parsed_result->results && sizeof($parsed_result->results) > 0) {
  $name = $parsed_result->results[0]->title;

  // if we have a result
  $score = $parsed_result->results[0]->score;
  //echo "score $score<br/>";

  $metadata = $parsed_result->results[0]->metadata;
  $decision = $metadata->decision;

  if($decision == "happy") {
    echo "<img src='images/happy-cow.png' id='cow'>";
  } else if ($decision = "sad") {
    echo "<img src='images/sick-cow.png' id='cow'>";
  }

  echo "<p>$name</p>";
  # Render detailed attributes
  foreach($metadata as $key => $value) {
    if($key != "decision") {
      if($value == 1) {
        echo "<div id='details' style='background-color: rgb(20,108,33);margin: 2px;border-radius: 4px;padding:7px'>$key</div>";
      } else {
        $fixed_key = preg_replace("/No/", "", $key);
        $fixed_key = preg_replace("/no/", "", $fixed_key);
        $fixed_key = preg_replace("/Not/", "", $fixed_key);
        $fixed_key = preg_replace("/not/", "", $fixed_key);
        $fixed_key = preg_replace("/Free/", "", $fixed_key);
        $fixed_key = preg_replace("/free/", "", $fixed_key);
        echo "<div id='details' style='background-color: rgb(141,6,0);margin: 2px;border-radius: 4px;padding:7px'>$fixed_key</div>";
      }
    }
  }

} else {
  echo "<img src='images/confused-cow.png' id='cow'>";
}?>
</div>
	<? include ('form.php') ?>
    <h2>Settings</h2>
    <form>

      <fieldset data-role="controlgroup" data-theme="a">
        <input type="checkbox" name="checkbox-1" id="checkbox-1" checked="checked" class="custom" />
        <label for="checkbox-1">Antibiotic Free</label>
        <input type="checkbox" name="checkbox-2" id="checkbox-2" class="custom" />
        <label for="checkbox-2">Certified Organic</label>
        <input type="checkbox" name="checkbox-3" checked="checked" id="checkbox-3" class="custom" />
        <label for="checkbox-3">Kosher</label>
      </fieldset>

    </form>

  </div><!-- /content -->
</div><!-- /page -->


</body>
</html>
