
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YCSPout</title>
  <link rel="icon" href="<?php echo $path_to_logo = "images/log.png";?>" type="image/png">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+z1s/JmLXaut9tPIGhclksx5qKGCDLIpuU1xJ2h" crossorigin="anonymous">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">

  <style>
  .div1 img{
    width: 100%;
    margin-top: 6rem;
  }
   /* Increase favicon size */
   link[rel="icon"] {
            width: 32px; /* Adjust the width as needed */
            height: 32px; /* Adjust the height as needed */
        }
</style>
</head>
<body>

<nav class="navbar">
  <div class="container-flui">
    <a class="navbar-brand" href="#">
      <img src="images/log.png" alt="Hangahub" width="50" height="50" class="d-inline-block align-top"><p style="color:beige;">You Can Speak Out</p>
    </a>
    <div class="navbarNav" style="margin-left: 900px; margin-right: 100px;" >
      <a class="nav-link active" aria-current="page" href="#" onclick="">Home</a>
      <a class="nav-link" href="#" onclick="toggleSignup()">Signup</a>
      <a class="nav-link" href="#" onclick="toggleLogin()">Login</a> <!-- Added Login link -->
    </div>
  </div>
</nav>


<div class="container-fluid">
  <header class="jumbotron">
    <h1>Welcome to YCSPout Platform Its your time to improve public speaking skills.</h1>
    <p style="font-size:1.5rem; font-style: italic;  background-color: rgb(236, 228, 228);" >From begnning level to high level of public speaking.</p>
  </header>

  <section class="section-one">
  <section>
  <div id="signupForm" style="display: none;margin-left: 900px; margin-right: 100px; font-size:larger;" >
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div id="box">
          
          <form method="post" action="signup.php" id="registrationForm" onsubmit="registerUser(event)">
            <div style="font-size: 20px;margin-top: -705x; color: rgba(54, 15, 196, 0.829);">Signup here</div>
            <label for="names">Full Names</label><br><br>
            <input id="text" type="text" name="names" placeholder="Your names"><br><br>
            <label for="address">Email address </label><br><br>
            <input id="text" type="text" name="Email" placeholder="Email address"><br><br>
           
            <label for="role">Password</label><br><br>
            <input id="text" type="password" name="password" placeholder="Password"><br><br>
            <input id="button" type="submit" value="Register" onclick="toggleLogin()"><br><br>
             <p>Already have account <a href="#" onclick="toggleLogin()">Login here</a></p> <!-- Clicking this will toggle login form -->
            <a href="#" onclick="toggleSignup()">Close form</a><br><br>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="loginForm" style="display: none;margin-left: 900px;"> <!-- Hidden login form -->
  <form method="post" action="login.php">
    <div style="font-size: 20px; margin: 10px; margin-top: -70px; color: white;">Login</div>
    <label for="email">Email</label><br>
    <input id="email" type="text" name="email" required><br><br>
    <label for="password">Password</label><br>
    <input id="password" type="password" name="password" required><br><br>
    <input type="submit" value="Login">
  </form>
</div>

 </section>
 <div class="cont" style="display:grid;grid-template-columns: 1fr 1fr; margin-left: 3rem;">
  <div class="div1" style="width:100%;">
  <img src="images/backgr.png" alt="ycspt" style="height:20rem;width:38rem">
    
    <p style="font-size:1.2rem; font-style: italic; background-color: rgb(236, 228, 228);padding:0.4rem;">Public speaking is a skill that you can learn. It's like riding a bicycle or typing. If you're willing to work at it, you can rapidly improve the quality of every part of your life.</p>
  </div>
  <div class="div1" style=" margin-left: 2rem; background-color: rgb(236, 228, 228); height:10rem;margin-right: 1rem; padding-left:1rem;margin-top: 10rem;"style=" margin-left: 2rem; background-color: rgb(236, 228, 228); height:10rem;margin-right: 1rem; padding-left:1rem;margin-top: 10rem;">
    <!-- <img src="images/cnc.png" alt="CNC" > -->
    <h2>About YCSPOut</h2>
    <p style="font-size:1.2rem; font-style: italic;"> YCSPOut is a comprehensive educational tool, guiding students from foundational public speaking skills to advanced levels.</p>
  </div>
  <div class="div1">
    <img src="images/conn.png" alt="conn" style="height:20rem;width:18rem">
    <img src="images/ed.png" alt="ed" style="height:20rem;width:18rem">
    <p style="font-size:1.2rem; font-style: italic; background-color: rgb(236, 228, 228); padding:0.4rem;">Every opportunity to speak is a chance to improve yourself. It tie to use " ONE SMARTPHONE TO ONE HOUSEHOLD IN EVERY VILLAGE" from ConnectRwanda initiative.</p>
  </div>
  <div class="div1" style=" background-color: rgb(236, 228, 228); height:10rem;margin-right: 1rem; padding-left:1rem; margin-top: 10rem;">
  <h1>Impact </h1>
    <p style="font-size:1.2rem; font-style: italic;">An innovative platform designed to empower students, particularly those from rural areas, with practical public speaking skills, leveraging opportunities provided by the ConnectRwanda initiative. </p>
  </div>
</div>

</div>

<footer class="footer">
  <div class="container text-center">
    <p>&copy; 2024 YCSPOut. All Rights Reserved.</p>
  </div>
</footer>

<!-- Bootstrap JS (optional if you need dropdowns or toggling features) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-zoGscyZmYpBfYzEJz1z9sUvz5+Ak2kIyBEJ6vGyyzY6ZmZl8ebvMEtFkpfQ8eqlJ" crossorigin="anonymous"></script>

<script>
  // Function to handle form submissio

  function toggleSignup() {
    var signupForm = document.getElementById("signupForm");
    var loginForm = document.getElementById("loginForm");
    if (signupForm.style.display === "none") {
      signupForm.style.display = "block";
      loginForm.style.display = "none";
    } else {
      signupForm.style.display = "none";
    }
  }

  function toggleLogin() {
    var loginForm = document.getElementById("loginForm");
    if (loginForm.style.display === "none") {
      loginForm.style.display = "block";
      signupForm.style.display = "none";
    }
  }
</script>



</body>
</html>










































