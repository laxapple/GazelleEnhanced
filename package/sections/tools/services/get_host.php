<?
if(isset($_SERVER['http_if_modified_since'])) {
	header("Status: 304 Not Modified");
	die();
}

header('Expires: '.date('D, d-M-Y H:i:s \U\T\C',time()+3600*24*120)); //120 days
header('Last-Modified: '.date('D, d-M-Y H:i:s \U\T\C',time()));

if(!check_perms('users_view_ips')) { die('Access denied.'); }

$Octets = explode(".", $_GET['ip']);
if(
	empty($_GET['ip']) ||
	!preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $_GET['ip']) ||
	$Octets[0] < 1 ||
	$Octets[0] > 255 ||
	$Octets[1] < 1 ||
	$Octets[1] > 255 ||
	$Octets[2] < 1 ||
	$Octets[2] > 255 ||
	$Octets[3] < 1 ||
	$Octets[3] > 255 ||
	$Octets[0] == 127 ||
	$Octets[0] == 192
) {
	die('Invalid IP.');
}

$Output = explode(' ',shell_exec('host -W 1 '.escapeshellarg($_GET['ip'])));
if(count($Output) == 1 && empty($Output[0])) {
	//No output at all implies the command failed
	trigger_error("get_host() command failed with no output, ensure that the host command exists on your system and accepts the argument -W");
}

if(count($Output)!=5) {
	die('Could not retrieve host.');
} else {
	die($Output[4]);
}

