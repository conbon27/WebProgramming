<!DOCTYPE HTML>
<html>
<head><title>Contact</title>
<link href="style.css" type="text/css" rel="stylesheet">
<link href="https://fonts.google.com/?category=Sans+Serif">
<script src="formcon.js">
</script>
<script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // must add zero in front of numbers < 10
    return i;
}
</script>
</head>
<body onload="startTime()">
<div id="txt"></div>
<div class="header">
	<h1><a href=index.html>Cat got your Tongue?</h1>
</div>
<div class="nav">
	<ul>
		<li><a href=index.html> Home</a></li>
		<li><a href=about.html> About</a></li>
		<li><a href=contact.php>Contact Us</a></li>
		<li><a href=offers.html>Special Offers</a></li>
		<li><a href=links.html>Useful Links</a></li>
    <li><a href=login.php>Admin</a></li>
	</ul>
	</div>
	<div ="contact">
		<p>Our staff are dedicated to you . . . always ;)<br>
        <a href=login.php>View Enquiries</a>
    </p>
	</div>
	<div class = "our">
	<div class ="test">
	<h2>Our Staff:</h2>
		<h3>Fulfilment Executive:</h3>
		<p>John Marsdon<br>
		091 471234<br>
		<a href="mailto:johnmarsdon@cgyt.ie?Subject=Taxidermy%20Query"target="_top">johnmarsdon@cgyt.ie</a></p>
		<h3>Marketing Officer:</h3>
		<p>Sheila Higginbottom<br>
		091 471233<br>
		<a href="mailto:sheilahigginbottom@cgyt.ie?Subject=Taxidermy%20Query"target="_top">sheilahigginbottom@cgyt.ie</a></p>
		<h3>Secretary:</h3>
		<p>Fidel McGrath<br>
		091 471222<br>
		<a href="mailto:fidelmcgrath@cgyt.ie?Subject=Taxidermy%20Query"target="_top">fidelmcgrath@cgyt.ie</a></p>
	<p><br>Please feel free to send us your enquiries<br>Any time, day or night</p>
	</div>
		<div class="test2">
	<div ="formcon">
	<!--<form name='conform' onSubmit="return submitf();" method="post">
	-->
<?php
  // define variables and set to empty values
  $nameErr = $emailErr = "";
  $name = $email = $message = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
    }

    if (empty($_POST["message"])) {
      $message = "";
    } else {
      $message = test_input($_POST["message"]);
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <ul>
	<li>
	Please select to which category your question best adheres to:
	<select><option>Sales</option><option>Stuffing</option><option>Post-Sales</option><option>Other</option></select><br><br>
	</li>
	<li><label for="message">Summary of Query:</label></li>
	<textarea name=message rows=6 cols=24></textarea><br>
	<li><label for="name">Name:</label></li>
	<input type=text name=fname value="" size=20><br>
	<li><label for="email">Email:</label></li>
	<input type=text name=email value="" size=20><br>
	</ul>
	<input type="submit" name="submit" value="Submit"/>
	</form>
</div>
		<div class = sol>
<div class="cara" style="max-width:50% max-height=100px;float: center; " >
  <img class="imgchange" src="image3.jpg">
  <img class="imgchange" src="image19.jpg">
  <img class="imgchange" src="image5.jpg">
</div>
<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("imgchange");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 2100); // Change image every 2.1 seconds
}
</script>
</div>
	</div>
	</div>
		<div class="foot">
		<p>&copy catgotyourtongue.ie All content is registered to their original owners unless otherwise stated.</p>
</div>
</body>
</html>
