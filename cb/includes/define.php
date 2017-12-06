<?php
$message;
define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST'].'/work/cb/');//local
define('EBH_HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST'].'/easybuyhealth/');//local
//define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST'].'/ebh-console/');//live

define("IMG_PATH",HTTP_SERVER."administrator/");
define("WEBSITE_URL","http://localhost/work/cb");
define("EBH_WEBSITE_URL","http://localhost/easybuyhealth/app/portal/");

define("MODULE_PATH",HTTP_SERVER."portal/modules/");

setcookie("HTTP_SERVER",HTTP_SERVER);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'easybuyh_livedb');

define('DOC_ROOT',$_SERVER['DOCUMENT_ROOT']."/work/cb/");

define("WRONG_PASSWORD","Invalid Login Credentials");

define("email_footer","<p>Best Regards,<br>Team EBH</p><br><p>Please do not reply to this mail. This is an auto generated mail and replies to this email id are not attended to. Please call us at our 24-hour customer care centre for any queries or clarifications.</p>");


function search($array, $key, $value)
{
	$results = array();

	if (is_array($array))
	{
		if (isset($array[$key]) && $array[$key] == $value)
			$results[] = $array;

		foreach ($array as $subarray)
			$results = array_merge($results, search($subarray, $key, $value));
	}

	return $results;
}
?>