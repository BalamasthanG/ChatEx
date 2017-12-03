<?php
session_start();

?>
<html>
<head>
<!-- <script type="text/javascript" src="/ChatEx/js/pingEvent.js"></script> -->
<link rel="stylesheet" href="/ChatEx/css/ping_page.css" />
</head>
<body>
	<div class="page-header">
		<?php echo $_SESSION['sessionId']; ?>
		<label>Chatting with</label>
		<?php echo $_REQUEST['opener'];?>
	</div>
	<input type="text" id="txt_message" />
	<button id="ping_send">Send</button>	
</body>
</html>
