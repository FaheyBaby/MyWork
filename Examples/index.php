<?php include("header.inc.php"); ?>
<?php
      $reg = @$_POST['reg'];

      $login = @$_POST['login'];

      $fn = "";
      $ln = "";
      $un = "";
      $em = "";
      $em2 = "";
      $pswd = "";
      $pswd2 = "";
      $d = "";
      $u_check = "";

      $fn = strip_tags(@$_POST['fname']);
      $ln = strip_tags(@$_POST['lname']);
      $un = strip_tags(@$_POST['username']);
      $em = strip_tags(@$_POST['email']);
      $em2 = strip_tags(@$_POST['email2']);
      $pswd = strip_tags(@$_POST['password']);
      $pswd2 = strip_tags(@$_POST['password2']);
      $d = date("Y-m-d");

      if ($reg) 
      {
            if ($em == $em2) 
            {

                  $u_check = mysqli_connect("localhost","root","HorizonCode2015","the_debate");
                  // Check connection
                  if (mysqli_connect_errno())
                  {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }

                  $check = "SELECT username, email FROM users WHERE username = '$un', email = '$em'";

                  if ($result=mysqli_query($u_check,$check))
                  {

                        $rowcount = mysqli_num_rows($result);

                        if ($rowcount == 0) 
                        {

                              if ($fn&&$ln&&$un&&$em&&$em2&&$pswd&&$pswd2) 
                              {

                                    if ($pswd == $pswd2) 
                                    {

                                          if (strlen($un)>20) 
                                          {
                                                echo "Your username must be less than 20 characters";
                                          }
                                          else
                                          {

                                                if (strlen($pswd)>24||strlen($pswd)<4) 
                                                {
                                                      echo "Your password must be between 4 and 24 characters long";
                                                }
                                                else 
                                                {

                                                      $pswd = md5($pswd);
                                                      $pswd2 = md5($pswd2);
                                                      $query = mysqli_query($u_check,"INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$pswd', '$d', '0')");
                                                      header("location: $un");
                                                      exit();
                                                }
                                          }
                                    }
                                    else 
                                    {
                                          echo "Your passwords don't match";
                                    }
                              }
                              else
                              {
                                    echo "Please fill in all of the fields";
                              }
                        }
                        else
                        {
                              echo "This username is already in use";
                        }
                  }
                  else 
                  {
                        echo "Your E-mails don't match";
                  }
            }
      }

      // user login code
      if($login)
      {
            if (isset($_POST["user_login"]) && isset($_POST["password_login"]))
            {
                  $user_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["user_login"]);
                  $password_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password_login"]);
                  $password_login_md5 = md5($password_login);

                  $test = mysqli_connect("localhost","root","HorizonCode2015","the_debate");
                  
                  if (mysqli_connect_errno())
                  {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }

                  $sql = "SELECT id FROM users WHERE username='$user_login' AND password='$password_login_md5' LIMIT 1";
                  
                  if ($result=mysqli_query($test,$sql))
                  {
        
                        $rowcount=mysqli_num_rows($result);
                        if ($rowcount == 1)
                        {
                              while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
                              {
                                    $id = $row["id"];
                              }
                              $_SESSION["user_login"] = $user_login;
                              header("location: $user_login");
                              exit();
                        }
                        else
                        {
                              echo 'That information is incorrect, try again';
                              exit();
                        }
                  }
            }
      }

?>
<body>
      <!-- MAIN DIV WHICH INCLUDES ALL ELEMENTS ON THE PAGE -->
      <div class="main">
            <!-- THIS TEXT DIV CONTAINS THEDEBATE TEXT -->
            <div class="text">
                  <h1 class="the">the</h1><h1 class="debate">DEBATE</h1>
            </div>
            <!-- THIS BUTTONCONTAINER DIV CONTAINS THE TWO BUTTONS ON THE PAGE -->
            <div class="buttonContainer">
                  <!-- THIS BUTTON WILL OPEN A SMALL DIV TO ALLOW USERS TO INPUT INFO AND LOGIN -->
                  <button  onclick="login()" class="login">Login</button>
                        <!-- THIS IS THE FIRST_LOGIN DIV THAT IS HIDDEN UNTIL YOU HIT THE BUTTON ABOVE -->
                        <div class="first_login">
                        <!-- THIS IS THE H1 TEXT IN THE FIRST_LOGIN DIV -->
                        <h1>LOGIN TO GET STARTED</h1>
      <!-- THIS IS THE FORM FOR SIGNING IN -->
      <form action="index.php" method="POST">
            <input type="text" name="user_login" size="25" placeholder="Username" class="top" required/><br /><br/>
            <input type="password" name="password_login" size="25" placeholder="Password" required/><br /><br/>
            <input type="submit" id="submit" class="login" name="login" value="Proceed"/>
      </form>
      <div class="buttonContain">
            <button id ="return" class="login" onclick="login()">Return</button>
      </div>
</div>
<!-- THIS BUTTON WILL OPEN A SMALL DIV TO ALLOW USERS TO INPUT INFO AND SIGN UP -->
<button onclick="signUp()" class="signup">Sign Up</button>
<!-- THIS IS THE POPUP DIV THAT IS HIDDEN UNTIL YOU HIT THE BUTTON ABOVE -->
<div class="popup">
      <!-- THIS IS THE TEXT AT THE TOP OF THE POPUP DIV -->
      <h1>FILL OUT THE INFORMATIOIN BELOW</h1>
      <!-- FORM THAT HOLDS ALL THE INPUT FIELDS FOR THE USER TO USE -->
      <form action="index.php" method="POST">
            <input type="text" name="fname" size="25" placeholder="First Name" class="top" required/><br /><br />
            <input type="text" name="lname" size="25" placeholder="Last Name" required/><br /><br />
            <input type="text" name="username" size="25" placeholder="UserName" required/><br /><br/>
            <input type="text" name="email" size="25" placeholder="Email Address" required/><br /><br/>
            <input type="text" name="email2" size="25" placeholder="Confirm Email" required/><br /><br/>
            <input type="password" name="password" size="25" placeholder="Password" required/><br /><br/>
            <input type="password" name="password2" size="25" placeholder="Confirm Password" required/><br /><br/>
            <input type="submit" class="login" id="submit" name="reg" value="Register" />
      </form>
      <div class="buttonContain">
            <button id ="return" class="login" onclick="signUp()">Return</button>
      </div>
</div>
</div>
<!-- THIS QUOTE DIV CONTAINS THE QUOTE AND PARAGRAPHS INSIDE IT -->
<div class="quote">
      <p><q>Your time is limited, so don't waste it living someone else's life. Don't be trapped by dogma - which is living with the results of other people's thinking. Don't let the noise of others' opinions drown out your own inner voice. And most important, have the courage to follow your heart and intuition.</q><p class="steve"><br>- Steve Jobs</p></p>
</div>
<!-- THIS COPY DIV CONTAINS THE COPYRIGHT LOGO FOR THE PAGE AT THE BOTTOM -->
<div class="copy">&copy; theDEBATE 2015</div>
</div>
</body>
</html>