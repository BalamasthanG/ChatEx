<?php


?>
<html>
<head>
<script type="text/javascript" src="/ChatEx/js/callEvent.js"></script>
<link rel="stylesheet" href="/ChatEx/css/friend_search.css" />
</head>
<body>
	<input type="text" id="friend_search" onkeyup="callEvent(this,'friend_search_response')"/>
	<p>Suggestions: <span id="friend_search_response"></span></p>
	<div id="member_card" class="overlay" onclick="overlayOff(this)"></div>
</body>
</html>
