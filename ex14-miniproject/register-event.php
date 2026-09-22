<?php
require_once "config/auth.php"; requireLogin("login.php"); require_once "config/database.php";
$uid=(int)$_SESSION["user_id"]; $eid=(int)($_GET["id"]??0);
if($eid>0){$s=$conn->prepare("INSERT IGNORE INTO event_registrations(user_id,event_id) VALUES(?,?)");$s->bind_param("ii",$uid,$eid);$s->execute();flash($s->affected_rows?"Event registration successful!":"You have already registered for this event.",$s->affected_rows?"success":"error");$s->close();}
header("Location: events.php");exit;
?>
