<!DOCTYPE HTML>
<html>
<head>
  <link href="style.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.google.com/?category=Sans+Serif">
  <script src="formcon.js">
  </script>
<title>Stock</title>
</head>
<body>

<h1>View Stock</h1>

<?php
include('connect.php');

// returns DB data
if ($result = $conn->query("SELECT * FROM stock ORDER BY id"))
{
// only display if data exists
if ($result->num_rows > 0)
{
// output to table
print "<table border='2' cellpadding='6'>";

// set table headers
print "<tr><th>ID</th><th>Units</th><th>Product Price</th><th>Product Name</th></tr>";

while ($row = $result->fetch_object())
{
// prints out row for each data point
print "<tr>";
print "<td>" . $row->id . "</td>";
print "<td>" . $row->units . "</td>";
print "<td>" . $row->price . "</td>";
print "<td>" . $row->name . "</td>";
print "<td><a href='admin.php?id=" . $row->id . "'>Edit</a></td>";
print "<td><a href='delete.php?id=" . $row->id . "'>Delete</a></td>";
print "</tr>";
}

print "</table>";
}
else
{
print "No issues today!";
}
}
// or DB error
else
{
print "Error: " . $conn->error;
}

// close DB connection
$conn->close();

?>

<a href="admin.php">Add New Enquiry</a>
</body>
</html>
