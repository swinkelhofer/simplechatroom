<?php
	if(isset($_POST["submit"]))
	{
		$time = time();

		$suchen   = array( 'ä', 'ö', 'ü', 'ß', 'Ä', 'Ö', 'Ü', "'");
		$ersetzen = array( '&auml;', '&ouml;', '&uuml;', '&szlig;', '&Auml;', '&Ouml;', '&Uuml;', '&apos;');		

		$name = str_replace($suchen, $ersetzen, htmlspecialchars($_POST["name"]));
		$text = str_replace($suchen, $ersetzen, htmlspecialchars($_POST["text"]));
		if($db = sqlite_open('db.sqlite'))
		{
	        $q = @sqlite_query($db, 'SELECT * FROM save');
	        if($q === false)
	        {
	        	sqlite_exec($db, 'CREATE TABLE save (time INTEGER, name VARCHAR(60), txt VARCHAR(200))');
	        	if(sqlite_exec($db, 'INSERT INTO save (time, name, txt) VALUES (\'' . $time . '\', \'' . $name . '\', \'' . $text . '\')') === false)
	        		echo("Error in creation");

	        }
	        else
	        {
	            if(sqlite_exec($db, 'INSERT INTO save (time, name, txt) VALUES (\'' . $time . '\', \'' . $name . '\', \'' . $text . '\')')=== false)
	            	echo('INSERT INTO save (time, name, txt) VALUES (\'' . $time . '\', \'' . $name . '\', \'' . $text . '\')');
	        }
	    }
	    else {
	        die($err);
	    }
	    sqlite_close($db);
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<META HTTP-EQUIV="Expires" CONTENT="-1">
		<title>ZAWiW-Logger</title>
		<link rel="stylesheet" type="text/css" href="reset.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href='http://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="mootools.js"></script>
		<script type="text/javascript">
			window.addEvent('domready', function(){insert(); startTimer();});
			function insert()
			{
				$$('#container').set('load', {noCache: 'true'});
				$$('#container').load('get.php');
			}
			function startTimer()
			{
				window.setInterval("insert()", 1000);
			}
			function test()
			{
				if(($$('#name').getProperty('value') == "") || ($$('#text').getProperty('value') == ""))
					$$('#submit').setProperty('disabled', 'true');
				else
					$$('#submit').removeProperty('disabled');
			}
		</script>
	</head>
	<body>
		<div id="main">
		<div id="panel">
			<form method="POST" name="form">
				<table>
					<tr>
						<td><input type="text" name="name" id="name" onChange="test()" onKeyUp="test()" placeholder="Name" /></td>
						<td rowspan="2" id="submit_td"><input type="submit" value="Abschicken" name="submit" id="submit" disabled="true" />
					</tr>
					<tr>
						<td><input type="text" name="text" id="text" onChange="test()" onKeyUp="test()" placeholder="Text" /></td>
					</tr>
				</table>
			</form>
		</div>
		<div id="container">

		</div>
	</div>
	</body>
</html>