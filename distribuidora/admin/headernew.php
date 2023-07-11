<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>jQuery MenuFlip Demo</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
	<div id="viewport">
		<div id="card">
			<div id="front">
				<!--front content start-->
				<div class="power"></div>
				<div class="powerdown"></div>
				<!--front content end-->
			</div>
			<div id="back">
				<!--back content start-->
				<ul class="mainmenu">
					<li><img src="images/palette.png" alt="Palette icon" class="icon"><span>Themes</span></li>
						<ul class="submenu">
							<div class="expand-triangle"><img src="images/expand.png"></div>
							<li id="theme1" class="chosen"><span>Blue</span></li>
							<li id="theme2"><span>Teal</span></li>
						</ul>						
					<li><img src="images/user.png" alt="User icon" class="icon"><span>Account<span></li>
						<ul class="submenu">
							<div class="expand-triangle"><img src="images/expand.png"></div>
							<li><span>About</span></li>
							<li><span>Picture</span></li>
							<li><span>Email</span></li>
							<li><span>Website</span></li>
						</ul>
					<li><img src="images/envelope.png" alt="Envelope icon" class="icon"><span>Messages</span><div class="messages">23</div></li>
						<ul class="submenu">
							<div class="expand-triangle"><img src="images/expand.png"></div>
							<li><span>Inbox</span></li>
							<li><span>Draft</span></li>
							<li><span>Sent</span></li>
							<li><span>Trash</span></li>
						</ul>
					<li><img src="images/cog.png" alt="Cog icon" class="icon"><span>Settings</span></li>
						<ul class="submenu">
							<div class="expand-triangle"><img src="images/expand.png"></div>
							<li><span>Password</span></li>
							<li><span>Notifications</span></li>
							<li><span>Language</span></li>
							<li><span>Privacy</span></li>
							<li><span>Payments</span></li>
						</ul>
					<li><img src="images/key.png" alt="Key icon" class="icon"><span>Logout</span></li>
				</ul>
				<!--back content end-->
			</div>
		</div>
	</div>
</body>
<script src="js/script.js"></script>
<script src="js/retina.min.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</html>
