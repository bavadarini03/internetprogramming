<?php
if (session_status() === PHP_SESSION_NONE) session_start();
function requireLogin($loginPath="login.php") { if (!isset($_SESSION["user_id"])) { header("Location: $loginPath"); exit; } }
function requireAdmin($loginPath="../login.php") { if (!isset($_SESSION["user_id"]) || ($_SESSION["role"] ?? "") !== "admin") { header("Location: $loginPath"); exit; } }
function flash($msg,$type="success") { $_SESSION["flash"]=$msg; $_SESSION["flash_type"]=$type; }
?>
