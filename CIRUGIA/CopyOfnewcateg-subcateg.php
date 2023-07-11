<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>jQuery Context Menu Plugin Demo</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		
		<style type="text/css">
			BODY,
			HTML {
				padding: 0px;
				margin: 0px;
			}
			BODY {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 11px;
				background: #FFF;
				padding: 15px;
			}
			
			H1 {
				font-family: Georgia, serif;
				font-size: 20px;
				font-weight: normal;
			}
			
			H2 {
				font-family: Georgia, serif;
				font-size: 16px;
				font-weight: normal;
				margin: 0px 0px 10px 0px;
			}
			
			#myDiv {
				width: 150px;
				border: solid 1px #2AA7DE;
				background: #6CC8EF;
				text-align: center;
				padding: 4em .5em;
				margin: 1em;
				float: left;
			}
			
			#myList {
				margin: 1em;
				float: left;
			}
			
			#myList UL {
				padding: 0px;
				margin: 0em 1em;
			}
			
			#myList LI {
				width: 100px;
				border: solid 1px #2AA7DE;
				background: #6CC8EF;
				padding: 5px 5px;
				margin: 2px 0px;
				list-style: none;
			}
			
			#options {
				clear: left;
			}
			
			#options INPUT {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 11px;
				width: 150px;
			}
			
		</style>		
		
		<script src="jquery-1.4.2.min.js" type="text/javascript"></script>
		<script src="jquery.contextMenu.js" type="text/javascript"></script>
		<link href="jquery.contextMenu.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript">
			
			$(document).ready( function() {
				
				// Show menu when #myDiv is clicked
				$("#myDiv").contextMenu({
					menu: 'myMenu'
				},
					function(action, el, pos) {
					alert(
						'Action: ' + action + '\n\n' +
						'Element ID: ' + $(el).attr('id') + '\n\n' + 
						'X: ' + pos.x + '  Y: ' + pos.y + ' (relative to element)\n\n' + 
						'X: ' + pos.docX + '  Y: ' + pos.docY+ ' (relative to document)'
						);
				});
				
				// Show menu when a list item is clicked
				$("#myList UL LI").contextMenu({
					menu: 'myMenu'
				}, function(action, el, pos) {
					alert(
						'Action: ' + action + '\n\n' +
						'Element text: ' + $(el).text() + '\n\n' + 
						'X: ' + pos.x + '  Y: ' + pos.y + ' (relative to element)\n\n' + 
						'X: ' + pos.docX + '  Y: ' + pos.docY+ ' (relative to document)'
						);
				});
				
				// Disable menus
				$("#disableMenus").click( function() {
					$('#myDiv, #myList UL LI').disableContextMenu();
					$(this).attr('disabled', true);
					$("#enableMenus").attr('disabled', false);
				});
				
				// Enable menus
				$("#enableMenus").click( function() {
					$('#myDiv, #myList UL LI').enableContextMenu();
					$(this).attr('disabled', true);
					$("#disableMenus").attr('disabled', false);
				});
				
				// Disable cut/copy
				$("#disableItems").click( function() {
					$('#myMenu').disableContextMenuItems('#cut,#copy');
					$(this).attr('disabled', true);
					$("#enableItems").attr('disabled', false);
				});
				
				// Enable cut/copy
				$("#enableItems").click( function() {
					$('#myMenu').enableContextMenuItems('#cut,#copy');
					$(this).attr('disabled', true);
					$("#disableItems").attr('disabled', false);
				});				
				
			});
			
		</script>
	</head>
	
	<body>
		
		<h1>jQuery Context Menu Plugin Demo</h1>
		<p>
			This plugin lets you add context menu functionality to your web applications.
		</p>
		
		<p>
			<strong>Tip:</strong> Try using your keyboard to make a selection.
		</p>
		
		<p>
			<a href="http://abeautifulsite.net/2008/09/jquery-context-menu-plugin/">Back to the project page</a>
		</p>
		
		<h2>Demo</h2>
		
		<div id="myDiv">
			Right click to view the context menu
		</div>
		
		<div id="myList">
			<ul>
				<li>Item 1</li>
				<li>Item 2</li>
				<li>Item 3</li>
				<li>Item 4</li>
				<li>Item 5</li>
				<li>Item 6</li>
			</ul>
		</div>
		
		<div id="options">
			<p>
				<input type="button" id="disableItems" value="Disable Cut/Copy" />
				<input type="button" id="enableItems" value="Enable Cut/Copy" disabled="disabled" />
			</p>
			
			<p>
				<input type="button" id="disableMenus" value="Disable Context Menus" />
				<input type="button" id="enableMenus" value="Enable Context Menus" disabled="disabled" />
			</p>
		</div>
		
		<ul id="myMenu" class="contextMenu">
			<li class="edit"><a href="#edit">Edit</a></li>
			<li class="cut separator"><a href="#cut">Cut</a></li>
			<li class="copy"><a href="#copy">Copy</a></li>
			<li class="paste"><a href="#paste">Paste</a></li>
			<li class="delete"><a href="#delete">Delete</a></li>
			<li class="quit separator"><a href="#quit">Quit</a></li>
		</ul>
		
	</body>
</html>