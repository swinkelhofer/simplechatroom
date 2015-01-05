<?php
	$db = sqlite_open('db.sqlite');
	$time = time();
	@sqlite_query($db, 'DELETE FROM save');
	@sqlite_exec($db, 'INSERT INTO save (time, name, txt) VALUES (\'' . $time . '\', \'Simon Volpert\', \'Web 2.0\')');
	echo "Resetting database...";

?>