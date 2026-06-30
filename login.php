<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CampusHub Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{

height:100vh;

display:flex;

justify-content:center;

align-items:center;

background:linear-gradient(135deg,#F5EFE6,#EADBC8);

}

.login-box{

width:420px;

background:white;

padding:35px;

border-radius:18px;

box-shadow:0 10px 25px rgba(0,0,0,.15);

}

.logo{

font-size:55px;

text-align:center;

color:#C97B36;

margin-bottom:10px;

}

h2{

text-align:center;

color:#3E3A36;

margin-bottom:5px;

}

p{

text-align:center;

color:gray;

margin-bottom:25px;

}

.btn-login{

background:#C97B36;

color:white;

}

.btn-login:hover{

background:#B56A28;

color:white;

}

</style>

</head>

<body>

<div class="login-box">

<div class="logo">

<i class="bi bi-mortarboard-fill"></i>

</div>

<h2>CampusHub</h2>

<p>Student Management Portal</p>

<form action="login_process.php" method="POST">

<label class="form-label">

Role

</label>

<select class="form-select mb-3" name="role">

<option value="admin">Admin</option>

<option value="faculty">Faculty</option>

<option value="student">Student</option>

</select>

<label class="form-label">

Email

</label>

<input

type="email"

name="email"

class="form-control mb-3"

required>

<label class="form-label">

Password

</label>

<div class="input-group mb-4">

<input

type="password"

id="password"

name="password"

class="form-control"

required>

<button

class="btn btn-outline-secondary"

type="button"

onclick="togglePassword()">

<i class="bi bi-eye"

id="eyeIcon">

</i>

</button>

</div>

<button

class="btn btn-login w-100">

<i class="bi bi-box-arrow-in-right"></i>

Login

</button>

</form>

</div>

<script>

function togglePassword(){

    let password = document.getElementById("password");
    let eyeIcon = document.getElementById("eyeIcon");

    if(password.type === "password"){

        password.type = "text";

        eyeIcon.className = "bi bi-eye";

    }else{

        password.type = "password";

        eyeIcon.className = "bi bi-eye-slash";

    }

}

</script>
</body>
</html>