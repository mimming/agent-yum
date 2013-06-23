<!DOCTYPE html> 
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
$(function() {
  setTimeout(hideSplash, 2000);
});

function hideSplash() {
  $.mobile.changePage("#home", "fade");
	$("#img").center();
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
	</head> 
						
	<body> 

<div data-role="page" data-theme="a" id="splash" 
	style="background: #000; text-align:center;"> 
    <div class="splash" id="img">
        <img src="images/agent-yum.png" alt="splash" />
    </div>
</div>

<div id="home" data-theme="a" data-role="page">
	<div data-role="header">
		<h1>Agent Yum</h1>
	</div><!-- /header -->

	<div data-role="content">
	<? include ('form.php') ?>	
	</div><!-- /content -->
</div><!-- /page -->

</body>
</html>
