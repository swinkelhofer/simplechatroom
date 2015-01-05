<?php
	$db = sqlite_open('db.sqlite');

	$query = sqlite_query($db, 'SELECT * FROM save ORDER BY time DESC');
	while ($entry = sqlite_fetch_array($query))
	{
		echo("<div class=\"entry\"><div class=\"namefield\"><span>");
		echo($entry['name']);
		echo("</span></div><div class=\"textfield\"></span>");
		echo($entry['txt']);
		echo("</span></div></div>");
    }
?>