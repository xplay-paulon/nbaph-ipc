<?php
error_reporting(E_ALL);

$headers = apache_request_headers();
$timestamp = time();
$tsstring = gmdate('D, d M Y H:i:s ', $timestamp) . 'GMT';
$etag = md5($timestamp);
header("Last-Modified: $tsstring");
header("ETag: \"{$etag}\"");
header('Expires: Thu, 01-Jan-70 00:00:01 GMT');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
header('Content-type: text/html; charset=iso-8859-i');
if(isset($headers['If-Modified-Since'])) {
        //echo 'set modified header';
	if(intval(time()) - intval(strtotime($headers['If-Modified-Since'])) < 300) {
              header('HTTP/1.1 304 Not Modified');
              exit();
        }
}
flush();


if(!isset($_SESSION)){
	session_start();
}

$domain = str_replace("https://", "", $_SERVER['SERVER_NAME']);
$domain = str_replace("http://", "", $domain); 
if($domain != "nba.local"){
	$sql_db = "db48516_nba";
	//$sql_server = "nbadb.cgvo8mpef8im.ap-southeast-1.rds.amazonaws.com";
        //$sql_root = "nbauser1";
        //$sql_pwd = "nb@db1";

	$sql_server = "nbadb.cgvo8mpef8im.ap-southeast-1.rds.amazonaws.com";
	$sql_root = "nbaawsuser";
	$sql_pwd = "p@ssw0rd_123";	
}else{
	$sql_db = "nba";
	$sql_server = "localhost";
	$sql_root = "root";
	$sql_pwd = "password";	
}
$path = trim(dirname($_SERVER['PHP_SELF']),'/');

if($path != ""){ $path = $path.'/'; }
 
$base = "http://".$domain."/".$path; //for live

//$base = "http://$domain/";
$base = "/";

error_reporting(E_ERROR | E_PARSE);

$connect = mysqli_connect($sql_server, $sql_root, $sql_pwd, $sql_db);
//mysqli_set_charset($link, "iso-8859");
if(!$connect){
 die('Connect Error: ' . mysqli_connect_error());
}
/* remove by paulon feb. 13, 2014
if (isset($_COOKIE['nba_username'])) {
   $_SESSION['username'] = $_COOKIE['nba_username'];
   $_SESSION['email'] = $_COOKIE['nba_email'];

   setcookie("nba_username", $_SESSION['username'], time()+60*60*24*30);
   setcookie("nba_session", session_id(), time()+60*60*24*30);
} */ 

function seoUrl($string) {
        //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
        $string = strtolower($string);
        //Strip any unwanted characters
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
}
?>

