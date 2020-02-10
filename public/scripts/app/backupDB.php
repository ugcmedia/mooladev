<?php 
include ('dumper.php');
require ('../config.php');



try {
	$world_dumper = Shuttle_Dumper::create(array(
		'host' => 'localhost',
		'username' => env('DB_USERNAME'),
		'password' => env('DB_PASSWORD'),
		'db_name' =>env('DB_DATABASE') ,
	));
	// dump the database to gzipped file
	$world_dumper->dump(DB_DATABASE.'.sql.gz');
	// dump the database to plain text file
	$world_dumper->dump('world.sql');
} catch(Shuttle_Exception $e) {
	echo "Couldn't dump database: " . $e->getMessage();
}