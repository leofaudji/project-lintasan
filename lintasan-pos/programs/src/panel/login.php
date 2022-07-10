<?php
error_reporting(0);
session_start();
 
if(isset($_POST['password'])) {
    $login = $_POST['password'];
    if($login == "q1w2e3r4t5") {
        $_SESSION['email_admin'] = $_POST['password'];
        echo "<script type='text/javascript'>window.top.location='index.php';</script>";
        exit();
    }else{
        echo "<script type='text/javascript'>window.top.location='?p=fail';</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HGN_1</title>
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800,900" rel="stylesheet" type='text/css'>
  <link rel="stylesheet" href="../assets/css/material-dashboards.css">
  <script src="../assets/js/mouse.js"></script>
  <!-- Resources -->
<!-- Chart code -->
  <style>
html,
body {
  color: #54FE55;
}

*::selection {
  background: #1a4f1a;
}

.welcome .line {
  overflow: hidden;
  width: 0px;
  text-shadow: 0px 0px 10px #54FE55;
  height: 1rem;
  text-align: left;
}
.welcome .line1 {
  animation: type 0.5s 1s steps(20, end) forwards;
}
.welcome .line2 {
  animation: type 0.5s 1.5s steps(20, end) forwards;
}
.welcome .line3 {
  animation: type 0.5s 2s steps(20, end) forwards;
}

@keyframes type {
  to {
    width: 280px;
  }
}
form {
  position: absolute;
  right:20px;
  top: 20px;
  flex-direction: column;
  max-width: 400px;
}
form label {
  margin-bottom: 1rem;
  display: flex;
  flex-direction: column;
  text-shadow: 0px 0px 10px #54FE55;
}
form input {
  background: black;
  border: 1px solid #54FE55;
  margin-top: .5rem;
  padding: .5rem;
  color: #54FE55;
  text-shadow: 0px 0px 10px #54FE55;
  box-shadow: 0px 0px 5px #54FE55;
}
form input:focus {
  outline: none;
}
form button {
  padding: .5rem;
  background: #1a4f1a;
  color: #54FE55;
  border: 0;
  text-shadow: 0px 0px 10px #54FE55;
  box-shadow: 0px 0px 10px #1a4f1a;
  cursor: pointer;
}
form button:focus {
  outline: none;
}

@keyframes blink {
  0% {
    opacity: 0;
  }
  49% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
  100% {
    opacity: 1;
  }
}
.blink {
  animation-name: blink;
  animation-duration: 1s;
  animation-iteration-count: infinite;
}
</style>
<!-- Chart code -->

<!-- Chart code -->
</head>
<body>
  <main>
    <canvas class="plane-canvas" id="plane-canvas"></canvas>
    <canvas class="main-canvas" id="main-canvas"></canvas>
    <div id="chartdiv"></div>
    <div id="chartdivs"></div>
    <form action="" method="post">
                                <?php
                                if($_GET['p'] == "fail") {
                                    echo ' <center><span style="color:red">Please check your password</span><br><br></center>';
                                }
                               ?>
    <p class="welcome">
    <span class="blink">Enter Your pass</span>
   </p>
   <label for="">
      <input placeholder="password" type="password" name="password">
   </label>
   <button type="submit">< login ></button>
</form>
  </main>
<a href="https://t.me/HGN_B4NKLOG" target="_blank"><img id="logo" src="https://createjs.com/mediakit/createjs-badge-reverse.png"></a>

</body>

</html>