<!DOCTYPE html>
<!--
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
-->
<html>

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="user-scalable=no, width=device-width,
initial-scale=1.0, maximum-scale=1.0"/>

	<head> 
		<title>Agent Yum</title> 
		<link rel="stylesheet"
			href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css"/>
		<script
			src="http://code.jquery.com/jquery-1.7.1.min.js"></script>			
		<script
			src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
		<script src="js.js"></script>
		<link rel="stylesheet" href="style.css" type="text/css">
	<script type="text/javascript">
/*$(function() {
  setTimeout(hideSplash, 2000);
});
*/
function hideSplash() {
  //$.mobile.changePage("#home", "fade");
	//$("#img").center();
	// Hides mobile browser's address bar when page is done loading.
	      window.addEventListener('load', function(e) {
		          setTimeout(function() { window.scrollTo(0, 1); }, 1);
				        }, false);
}
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + 
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + 
                                                $(window).scrollLeft()) + "px");
    return this;
}
// Hides mobile browser's address bar when page is done loading.
      
		</script>
	<link rel="icon" type="image/png" href="/favicon.png" />
	</head> 
						
	<body> 


<div id="home" data-theme="a" data-role="page">
	<div data-role="header">
		<h1>Agent Yum</h1>
	</div><!-- /header -->
   <div class="splash" id="img">
        <img src="images/agent-yum-logo.png" alt="splash" />
    </div>


	<div data-role="content">
	<? include ('form.php') ?>	
	</div><!-- /content -->


 



</div><!-- /page -->

</body>
</html>
