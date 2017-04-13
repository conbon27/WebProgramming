<?php
/*
create & edit methods for enquiries
*/
include("connect.php");
// creates the new/edit record form
function renderForm($name = '', $email ='', $error = '', $id = '', $summary = '', $category = '')
{ ?>
<!DOCTYPE HTML>
<html>
<head>
  <link href="style.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.google.com/?category=Sans+Serif">
  <script src="formcon.js">
  </script>
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

Summary: <input type="text" name="summary"
value="<?php print $summary; ?>"/>
Name: <input type="text" name="name"
value="<?php print $name; ?>"/><br/>
Email: <input type="text" name="email"
value="<?php print $email; ?>"/>
Category: <input type="text" name="category"
value="<?php print $category; ?>"/>
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
$name = htmlentities($_POST['name'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$summary = htmlentities($_POST['summary'], ENT_QUOTES);
$category = htmlentities($_POST['category'], ENT_QUOTES);

// confirm data is not blank
if ($name == '' || $email == '' || $summary == '' || $category == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Missing Info!';
renderForm($name, $email, $summary, $id, $category);
}
else
{
// update in DB
if ($stmt = $conn->prepare("UPDATE contacts SET name = ?, email = ?, summary = ?, category = ?
WHERE id=?"))
{
$stmt->bind_param("ssi", $name, $email, $id, $summary, $category);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
print "ERROR: Invalid SQL statement.";
}

// redirect the user once the form is updated
header("Location: view.php");
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
if($stmt = $conn->prepare("SELECT * FROM contacts WHERE id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($id, $name, $email, $summary, $category);
$stmt->fetch();

// show the form
renderForm($name, $email, NULL, $id, $summary, $category);

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
header("Location: view.php");
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
$name = htmlentities($_POST['name'], ENT_QUOTES);
$email = htmlentities($_POST['email'], ENT_QUOTES);
$summary = htmlentities($_POST['summary'], ENT_QUOTES);
$category = htmlentities($_POST['category'], ENT_QUOTES);

// check variables not empty
if ($name == '' || $email == '' || $summary == ''|| $category == '')
{
// if empty, error message + form
$error = 'ERROR: Please fill in all required fields!';
renderForm($name, $email, $summary, $category, $error);
}
else
{
// insert record into DB
if ($stmt = $conn->prepare("INSERT contacts (name, email, summary, category) VALUES (?, ?, ?, ?)"))
{
$stmt->bind_param("ss", $name, $email, $summary, $category);
$stmt->execute();
$stmt->close();
}
else
{
print "ERROR: Invalid SQL statement.";
}
// redirect
header("Location: view.php");
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
