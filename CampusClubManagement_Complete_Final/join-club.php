<?php
require_once "config/auth.php"; requireLogin("login.php"); require_once "config/database.php";
$uid=(int)$_SESSION["user_id"]; $cid=(int)($_GET["id"]??0);
if($cid>0){$s=$conn->prepare("INSERT IGNORE INTO club_members(user_id,club_id) VALUES(?,?)");$s->bind_param("ii",$uid,$cid);$s->execute();flash($s->affected_rows?"Club joined successfully!":"You have already joined this club.",$s->affected_rows?"success":"error");$s->close();}
header("Location: clubs.php");exit;
?>
