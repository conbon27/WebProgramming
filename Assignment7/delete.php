<?php
include('connect.php');

// confirm ID variable is valid
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// get 'id' variable from form
$id = $_GET['id'];

// delete record - applies limit to number that can be deleted
if ($stmt = $conn->prepare("DELETE FROM contacts WHERE id = ? LIMIT 1"))
{
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
}
else
{
print "ERROR: could not prepare SQL statement.";
}
$conn->close();

// redirect delete is successful
header("Location: view.php");
}
else
// if the 'id' variable isn't set, redirect the user
{
header("Location: view.php");
}

?>
