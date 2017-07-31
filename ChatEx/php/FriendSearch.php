<?php


?>
<html>
<head>
<script type="text/javascript" src="/ChatEx/js/callEvent.js"></script>
</head>
<body>
	<input type="text" id="friend_search" onkeyup="callEvent(this,'friend_search_response')"/>
	<p>Suggestions: <span id="friend_search_response"></span></p>
</body>
</html>
