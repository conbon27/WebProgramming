<?php

include("connect.php");
function renderForm($units = '', $price ='', $error = '', $id = '', $name = '')
{ ?>
<!DOCTYPE HTML>
<html>
<head>
  <link href="style.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.google.com/?category=Sans+Serif">
<title>
  <?php if ($id != '') { print "Edit Record"; } else { print "New Record"; } ?>
</title>
</head>
  <body>
    <h1><?php if ($id != '') { print "Edit Record"; } else { print "New Record"; } ?></h1>
<?php if ($error != '') {
print "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<form action="" method="post">
<div>
<?php if ($id != '') { ?>
<input type="hidden" name="id" value="<?php print $id; ?>" />
<p>ID: <?php print $id; ?></p>
<?php } ?>

name: <input type="text" name="name"
value="<?php print $name; ?>"/>
Name: <input type="text" name="units"
value="<?php print $units; ?>"/><br/>
price: <input type="text" name="price"
value="<?php print $price; ?>"/>
<p>All fields required</p>
<input type="submit" name="submit" value="Submit" />
</div>
</form>
</body>
</html>

<?php }
/*
EDIT
*/
// edit a record on event
if (isset($_GET['id']))
{
// process the form on event
if (isset($_POST['submit']))
{
// validate id
if (is_numeric($_POST['id']))
{
// get variables from form
$id = $_POST['id'];
$units = htmlentities($_POST['units'], ENT_QUOTES);
$price = htmlentities($_POST['price'], ENT_QUOTES);
$name = htmlentities($_POST['name'], ENT_QUOTES);

// confirm data is not blank
if ($units == '' || $price == '' || $name == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Missing Info!';
renderForm($units, $price, $name, $id);
}
else
{
// update in DB
if ($stmt = $conn->prepare("UPDATE contacts SET units = ?, price = ?, name = ?
WHERE id=?"))
{
$stmt->bind_param("ssi", $units, $price, $id, $name );
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
print "ERROR: Invalid SQL statement.";
}

// redirect the user once the form is updated
header("Location: stock.php");
}
}
// if the 'id' variable is not valid, show an error message
else
{
print "Error!";
}
}
// if the form hasn't been submitted yet, get the info from the database and show the form
else
{
// make sure the 'id' value is valid
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the recod from the database
if($stmt = $conn->prepare("SELECT * FROM stock WHERE id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($id, $units, $price, $name, );
$stmt->fetch();

// show the form
renderForm($units, $price, NULL, $id, $name, );

$stmt->close();
}
else
{
print "Error: Invalid SQL statement";
}
}
// redirect if id invalid
else
{
header("Location: stock.php");
}
}
}

/*
New Data Methods
*/
// id not set = new enquiry
else
{
// form processed on submit event
if (isset($_POST['submit']))
{
// get the form data
$units = htmlentities($_POST['units'], ENT_QUOTES);
$price = htmlentities($_POST['price'], ENT_QUOTES);
$name = htmlentities($_POST['name'], ENT_QUOTES);

// check variables not empty
if ($units == '' || $price == '' || $name == '')
{
// if empty, error message + form
$error = 'ERROR: Please fill in all required fields!';
renderForm($units, $price, $name, $error);
}
else
{
// insert record into DB
if ($stmt = $conn->prepare("INSERT contacts (name, price, name) VALUES (?, ?, ?)"))
{
$stmt->bind_param("ss", $units, $price, $name, );
$stmt->execute();
$stmt->close();
}
else
{
print "ERROR: Invalid SQL statement.";
}
// redirect
header("Location: stock.php");
}
}
// show unsubmitted form
else
{
renderForm();
}
}
// close connection
$conn->close();
?>
