<?php 
include ("../../../inc/connect.inc.php"); 
date_default_timezone_set('Asia/Calcutta');
$datetime = date("Y-m-d H:i:sa");

session_start();
$email = $_SESSION["email1"];

$query = "SELECT * from table2 WHERE email='$email'";
$result = mysqli_query($con,$query);
$get = mysqli_fetch_assoc($result);
$fnamex = $get['fname'];

$challenge_id = mysqli_real_escape_string($con,$_GET['challengeidr']);

mysqli_query($con,"UPDATE mario_oneonone SET challenge_status='-2' WHERE challenge_id='$challenge_id'");

$query = "SELECT * from mario_oneonone WHERE challenge_id='$challenge_id'";
$result = mysqli_query($con,$query);
$get = mysqli_fetch_assoc($result);
$from_user_email = $get['from_user_email'];

mysqli_query($con,"INSERT INTO notifications (to_user,notif_text,notif_href,time_generated) VALUES ('$from_user_email','$fnamex has rejected your challenge request.',
	'games/one-on-one/mario/game.php?u=$challenge_id','$datetime')");

header("Location: ".$g_url."games/one-on-one/mario/game.php?u=".$challenge_id);

?>

