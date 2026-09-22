<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script>
var title = new String("User Registration");
document.title = title.toUpperCase();
</script>

<style>
body{
    font-family:Arial;
    background:#e6e6e6;
    margin:0;
}

.container{
    width:800px;
    margin:30px auto;
    background:#FFF5F5;
    padding:30px;
    border:1px solid gray;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
}

h2{
    text-align:center;
    color:white;
    background:#91008D;
    padding:10px;
}

table{
    width:100%;
}

td{
    padding:8px;
    width:50%;
}

label{
    font-weight:bold;
}

input,select,textarea{
    width:100%;
    padding:8px;
    margin-top:5px;
    box-sizing:border-box;
}

textarea{
    height:80px;
    resize:none;
}

button{
    width:100%;
    padding:10px;
    background:#91008D;
    color:white;
    border:none;
    font-size:16px;
    margin-top:15px;
    cursor:pointer;
}

button:hover{
    background:#004c99;
}

.error{
    color:red;
    font-size:13px;
    margin-top:3px;
}
</style>

</head>

<body>

<div class="container">

<h2>User Registration</h2>

<form id="userForm" action="register.php" method="post">

<table>

<!-- Full Name + Email -->
<tr>

<td>
<label>Full Name *</label>

<input type="text"
       id="fullname"
       name="fullname"
       placeholder="Enter your full name">

<div class="error" id="fullnameError"></div>
</td>

<td>
<label>Email *</label>

<input type="text"
       id="email"
       name="email"
       placeholder="Enter your email">

<div class="error" id="emailError"></div>
</td>

</tr>


<!-- Phone + Password -->
<tr>

<td>
<label>Phone Number *</label>

<input type="text"
       id="phone"
       name="phone"
       placeholder="Enter 10 digit phone number"
       >

<div class="error" id="phoneError"></div>
</td>

<td>
<label>Password *</label>

<input type="password"
       id="password"
       name="password"
       placeholder="Enter your password">

<div class="error" id="passwordError"></div>
</td>

</tr>


<!-- Confirm Password + Credit Card -->
<tr>

<td>
<label>Confirm Password *</label>

<input type="password"
       id="confirm"
       name="confirm"
       placeholder="Re-enter your password">

<div class="error" id="confirmError"></div>
</td>

<td>
<label>Credit Card Number *</label>

<input type="text"
       id="card"
       name="card"
       placeholder="Enter 16 digit card number"
       >

<div class="error" id="cardError"></div>
</td>

</tr>


<!-- DOB + Gender -->
<tr>

<td>
<label>Date of Birth *</label>

<input type="date"
       id="dob"
       name="dob">

<div class="error" id="dobError"></div>
</td>

<td>
<label>Gender *</label>

<select id="gender" name="gender">

<option value="">Select Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>

</select>

<div class="error" id="genderError"></div>
</td>

</tr>


<!-- Address -->
<tr>

<td colspan="2">

<label>Address *</label>

<textarea
    id="address"
    name="address"
    placeholder="Enter your complete address"></textarea>

<div class="error" id="addressError"></div>

</td>

</tr>


<!-- Terms -->
<tr>

<td colspan="2">

<input type="checkbox"
       id="agree"
       name="agree"
       value="Yes"
       style="width:auto;">

I agree to the Terms & Conditions

<div class="error" id="agreeError"></div>

</td>

</tr>


<!-- Submit -->
<tr>

<td colspan="2">

<button type="submit">
Register
</button>

</td>

</tr>

</table>

</form>

</div>


<script>

document.getElementById("userForm").addEventListener("submit", function(e){

    let valid = true;

    // Clear previous errors
    document.querySelectorAll(".error").forEach(function(error){
        error.innerHTML = "";
    });


    // Common required-field validation
    function check(id, message){

        let value = document.getElementById(id).value.trim();

        if(value === ""){
            document.getElementById(id + "Error").innerHTML = message;
            valid = false;
        }

        return value;
    }


    let fullname = check(
        "fullname",
        "Enter Full Name"
    );

    let email = check(
        "email",
        "Enter Email"
    );

    let phone = check(
        "phone",
        "Enter Phone Number"
    );

    let password = check(
        "password",
        "Enter Password"
    );

    let confirm = check(
        "confirm",
        "Confirm Password"
    );

    let card = check(
        "card",
        "Enter Credit Card Number"
    );

    check(
        "dob",
        "Select Date of Birth"
    );

    check(
        "gender",
        "Select Gender"
    );

    check(
        "address",
        "Enter Address"
    );


    // Stop form submission if invalid
    if(!valid){
        e.preventDefault();
    }

});

</script>

</body>
</html>