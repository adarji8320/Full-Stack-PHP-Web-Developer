<?php

function url(){
	return 	sprintf(	
					"%s://%s%s",
					isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
					$_SERVER['SERVER_NAME'],
					$_SERVER['REQUEST_URI']
					);
}

$API_URL = url() . '/api/album/read.php?user_id=1';

//No Albums Found
//$API_URL = url() . '/api/album/read.php?user_id=2';

//No User Found
//$API_URL = url() . '/api/album/read.php?user_id=3';

?>
