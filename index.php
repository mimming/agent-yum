<!DOCTYPE html> 
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
	</head> 
						
	<body> 
	
		<div data-role="page">
			<div data-role="header">
				<h1>Agent Yum</h1>
			</div><!-- /header -->

											
			<div data-role="content">
			<form action="upload.php" method="post"
			enctype="multipart/form-data">
			  <input type="file" name="image" accept="image/*" capture>
			    <input type="submit" value="Upload">
				</form>
			</div><!-- /content -->
		</div><!-- /page -->

	</body>
</html>
