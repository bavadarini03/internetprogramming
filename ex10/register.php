<?php

$errors = array();


// Get form values

$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$confirm = $_POST['confirm'] ?? '';
$card = trim($_POST['card'] ?? '');
$dob = $_POST['dob'] ?? '';
$gender = $_POST['gender'] ?? '';
$address = trim($_POST['address'] ?? '');
$agree = $_POST['agree'] ?? '';


if($fullname == ''){

    $errors[] = "Enter Full Name";

}
elseif(!preg_match("/^[A-Za-z ]+$/", $fullname)){

    $errors[] = "Name should contain only letters";

}


if($email == ''){

    $errors[] = "Enter Email";

}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

    $errors[] = "Enter a valid email address";

}


if($phone == ''){

    $errors[] = "Enter Phone Number";

}
elseif(!preg_match("/^[0-9]{10}$/", $phone)){

    $errors[] = "Enter 10 digit phone number ";

}


// Password validation

if($password == ''){

    $errors[] = "Enter Password";

}
elseif(strlen($password) < 6){

    $errors[] =
        "Password must contain at least 6 characters";

}


// Confirm Password

if($confirm == ''){

    $errors[] = "Confirm Password";

}
elseif($password != $confirm){

    $errors[] = "Passwords do not match";

}


// Credit Card validation

if($card == ''){

    $errors[] =
        "Enter Credit Card Number";

}
elseif(!preg_match("/^[0-9]{16}$/", $card)){

    $errors[] =
        "Enter 16 digit credit card number ";

}


// Date of Birth

if($dob == ''){

    $errors[] =
        "Select Date of Birth";

}


// Gender

if($gender == ''){

    $errors[] =
        "Select Gender";

}


// Address

if($address == ''){

    $errors[] =
        "Enter Address";

}


// Terms & Conditions

if($agree != 'Yes'){

    $errors[] =
        "Accept Terms & Conditions";

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<title>User Registration Details</title>

<style>

body{

    font-family:Arial;

    background:#e6e6e6;

    margin:0;

}

.container{

    width:700px;

    margin:40px auto;

    background:#FFF5F5;

    padding:30px;

    border:1px solid gray;

    box-shadow:
        0 0 10px rgba(0,0,0,0.2);

}

h2{

    text-align:center;

    color:white;

    background:#91008D;

    padding:10px;

}

table{

    width:100%;

    border-collapse:collapse;

}

td{

    padding:10px;

    border-bottom:
        1px solid #ddd;

}

.label{

    font-weight:bold;

    color:#555;

    width:40%;

}

.error{

    color:red;

    font-weight:bold;

    text-align:center;

    margin:10px;

}

.success{

    color:green;

    font-weight:bold;

    text-align:center;

}

</style>

</head>


<body>


<div class="container">


<?php if(!empty($errors)){ ?>


<h2>Registration Failed</h2>


<div class="error">

<?php

foreach($errors as $error){

    echo htmlspecialchars($error);

    echo "<br>";

}

?>

</div>


<?php } else { ?>


<h2>User Registration Successful</h2>


<table>


<tr>

<td class="label">
Full Name
</td>

<td>
<?php
echo htmlspecialchars($fullname);
?>
</td>

</tr>


<tr>

<td class="label">
Email
</td>

<td>
<?php
echo htmlspecialchars($email);
?>
</td>

</tr>


<tr>

<td class="label">
Phone Number
</td>

<td>
<?php
echo htmlspecialchars($phone);
?>
</td>

</tr>


<tr>

<td class="label">
Password
</td>

<td>
<?php
echo htmlspecialchars($password);
?>
</td>

</tr>


<tr>

<td class="label">
Confirm Password
</td>

<td>
<?php
echo htmlspecialchars($confirm);
?>
</td>

</tr>


<tr>

<td class="label">
Credit Card Number
</td>

<td>

<?php


echo htmlspecialchars($card);

?>

</td>

</tr>


<tr>

<td class="label">
Date of Birth
</td>

<td>
<?php
echo htmlspecialchars($dob);
?>
</td>

</tr>


<tr>

<td class="label">
Gender
</td>

<td>
<?php
echo htmlspecialchars($gender);
?>
</td>

</tr>


<tr>

<td class="label">
Address
</td>

<td>
<?php
echo nl2br(
    htmlspecialchars($address)
);
?>
</td>

</tr>


<tr>

<td class="label">
Terms & Conditions
</td>

<td>
<?php
echo htmlspecialchars($agree);
?>
</td>

</tr>


</table>


<?php } ?>


</div>


</body>

</html>