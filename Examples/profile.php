<?php include("header.inc.php"); ?>
<?php
	if(isset($_GET['u']))
	{
		$con = mysqli_connect("localhost","root","HorizonCode2015","the_debate");

		if (mysqli_connect_errno()) 
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$username = mysqli_real_escape_string($con, $_GET['u']);

		if (ctype_alnum($username))
		{
			$check = mysqli_query($con,"SELECT username, first_name FROM users WHERE username='$username'");

			if ($result = $check)
  			{
  				$rowcount = mysqli_num_rows($result);
  				if ($rowcount === 1)
  				{
			  		$get = mysqli_fetch_assoc($result);
					$username = $get['username'];
					$firstname = $get['first_name'];
  				}
  				else
				{
					echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/theDebate/index.php\">";
					exit();
				}

  			}
			
		}
	}
?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="css/profile.css">
  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="js/debate.js"></script>
  <title></title>
</head>
<body>
<!-- THIS PAGE WAS DONE BY DAVID KEDDINGTON-->
<div id="wrapper">

<!-- NAVIGATION BAR Start -->
  <nav>
  <div class="mainLeftText">
    <h1><span id="mainText">the</span>DEBATE</h1>
  </div>
  <div class="searchBar">
    <form id="search">
      <input type="text" size="60" placeholder="Search...">
    </form>
  </div>
  <div class="navButtons">
    <ul>
      <li><button class="note">&#128276;</button></li>
      <li><button class="userMenu" onclick="menu()"><?php echo $username; ?></button>
      	<ul class="sub-menu">
      		<li class="topList"><p>Podium</p></li>
      		<li><p>Campaign</p></li>
      		<li><p>Feed</p></li>
      		<li><p>Settings</p></li>
      		<a href="logout.php"><li><p>Logout</p></li></a>
      	</ul>
      </li>
      <li><button class="newDebate" onclick="dark()"><span class="plus">+</span></button></li>
    </ul>
  </div>
</nav>
<!-- NAVIGATION BAR End -->


<!-- Profile Page Starts -->
  <div id="profile">
    <div id="avatar">
      <img src="img/smile-emoji.png">
      <a href="">Change</a>
    </div>
      <div id="recentMenu"  onclick="minimize()">
        <div id="recent">
          <h2>Podium</h2>
          <a href=""><img src="img/podium.png" onmouseover="this.src='img/podiumHover.png'" onmouseout="this.src='img/podium.png'" /></a>
          <h3>Active Debates: 5</h3>
          <h3>Comments Remaining: 5</h3>
          <h3>Suggested Debates: 0</h3>
        </div>
        <div id="recent">
          <h2>Audience</h2>
          <a href=""><img src="img/target-audience.png" onmouseover="this.src='img/target-audienceHover.png'" onmouseout="this.src='img/target-audience.png'"/></a>
          <h3>50</h3>
          <h5>- Kedds77 has joined your audience.</h5>
          <h5>- FaheyBaby24 has joined your audience.</h5>
        </div>
        <div id="recent">
          <h2>Achievements</h2>
           <a href=""><img src="img/Ribbon-icon.png" onmouseover="this.src='img/Ribbon-iconHover.png'" onmouseout="this.src='img/Ribbon-icon.png'"/></a>
          <h3>15</h3>
          <h5>- You have won 5 debates.</h5>
          <h5>- You have 50 people in your audience.</h5>
        </div>
        <div id="recent1">
          <h2>Score</h2>
           <a href=""><img src="img/medal.png" onmouseover="this.src='img/medalHover.png'" onmouseout="this.src='img/medal.png'" /></a>
          <h3>5,000</h3>
          <h5>10,000 points until next medal.</h5>
        </div>
      </div>

      <div class="postDebate">
      <form method="post">
        <input type="text" name="title" placeholder="Debate Topic" style="width: 230px; margin-right: 20px;"/>
        <select style="width: 230px; margin-left: 20px;" name="category">
          <option value="null">Select a Category</option>
          <option value="personal">Personal</option>
          <option value="community">Community</option>
          <option value="religion">Religion</option>
          <option value="politics">Politics</option>
          <option value="education">Education</option>
          <option value="sports">Sports</option>
          <option value="other">Other</option>
        </select>
        <textarea id="post" name="post"placeholder="Place your stance here..."></textarea>
        <h3>Who do you want to include in this debate?</h3>
        <div id="test">
        <input type="radio" id="radio1" name="cat" value="everyone" checked>
        <label for="radio1">Everyone</label>
        </div>
        <br>
        <div id="test">
        <input type="radio" id="radio2" name="cat" value="audience">
        <label for="radio2">Audience</label>
        </div>
        <br>
        <div id="test">
        <input type="radio" id="radio3" name="cat" value="group">
        <label for="radio3">Group</label>
        </div>
        <br>
        <div id="test">
        <input type="radio" id="radio4" name="cat" value="custom">
        <label for="radio4">Custom</label>
        </div>
        <br>
        <br>
        <div id="center">
          <h3>Select the end date of your debate</h3>
          <input type="date" name="bday">
        </div>
        <br>
        <br>
        <input type="submit" name="send" onclick="send_post()" value="Post" id="leftButton" />
        <input type="submit" name="return" onclick="dark()" value="Return" />
      </form>
      </div>

      <div id="yourFeed">
        <div id="agreeFeed">
          <h1>Agree Debates</h1>
          <div id="agree">
            <?php

              $con = mysqli_connect("localhost","root","HorizonCode2015","the_debate");

              if (mysqli_connect_errno()) 
              {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }

              $getposts = mysqli_query($con, "SELECT * FROM posts WHERE user_posted_to = '$username' ORDER BY id DESC LIMIT 10");

              while ($row = mysqli_fetch_assoc($getposts))
              {
                $id = $row['id'];
                $body = $row['body'];
                $date_added = $row['date_added'];
                $added_by = $row['added_by'];
                $user_posted_to = $row['user_posted_to'];

                echo "<div class='posted_by'><a href='$added_by'>$added_by</a> - $date_added - </div>&nbsp;&nbsp;$body<br /><hr/>";
              }
            ?>
          </div> 
        </div>
        <div id="disagreeFeed">
          <h1>Disagree Debates</h1>
          <div id="disagree">
            
          </div>
        </div>
      </div>
   </div>
</div>
<!-- Profile Page Ends -->
</body>
</html>