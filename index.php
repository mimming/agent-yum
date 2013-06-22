<? echo 'hello!' ?><!DOCTYPE html> 
<html> 
	<head> 
		<title>My Page</title> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet"
			href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css"/>
		<script
			src="http://code.jquery.com/jquery-1.7.1.min.js"></script>			
		<script
			src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
		<script type="text/javascript">
$(function() {
  setTimeout(hideSplash, 2000);
});

function hideSplash() {
  $.mobile.changePage("#home", "fade");
}
		</script>
	</head> 
						
	<body> 

<div data-role="page" data-theme="b" id="splash" style="background-color: #fff;"> 
    <div class="splash">
        <img src="images/agent-yum.png" alt="splash" />
    </div>
</div>

		<div id="home" data-theme="b" data-role="page">
			<div data-role="header">
				<h1>Agent Yum</h1>
			</div><!-- /header -->

											
			<div data-role="content">
			Hello! We will read food labels and tell you if this item is
			antibiotic-free and organic!
			<form action="upload.php" method="post"
			enctype="multipart/form-data" data-ajax="false">
			  <input type="file" name="image" accept="image/*" capture="camera">
			    <input type="submit" value="Upload">
				</form>
			</div><!-- /content -->
		</div><!-- /page -->

	</body>
</html>
