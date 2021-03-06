<?php
/* This code runs the SQL queries and outputs what happens as a result of the queries.
   It would be possible to have this code set messages in a session variable and pass this on to another page 
   (redirect with the header method) instead of printing the results here. 
   The X option demonstrates this ("silent" delete).
*/
session_start(); // this should be the very first statement when using sessions
// Report all PHP errors 
error_reporting(E_ALL);
/*	This file is a login page that will send the user to a secure page.
	There's a session 'msg' variable, which will be blank the first time (when not set).
*/
include("dbconnect.php");

$debugOn = true;

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Bulletin Processing</title>
</head>
<body>
<h1>Results</h1>
<?php
echo "<h2>Form Data</h2>";
echo "<pre>";
print_r($_REQUEST); // a useful debugging function to see everything in an array, best inside a <pre> element
echo "</pre>";
// execute the appropriate query based on which submit button (insert, delete or update) was clicked

if ($_REQUEST['submit'] == "Insert Entry")
{
	$expirydate = "$_REQUEST[exyear]-$_REQUEST[exmonth]-$_REQUEST[exday]";	
	include("upload_file_bulletin.php");
	$sql = "INSERT INTO bulletin (title, description, image, type, contact1, contact2, expirydate) VALUES 
	('$_REQUEST[title]', '$_REQUEST[description]', '$newFullName', '$_REQUEST[type]', '$_REQUEST[contact1]',
	 '$_REQUEST[contact2]', '$expirydate')";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	
	if ($dbh->exec($sql)){
		$query = "SELECT id, title FROM bulletin"; //Retrieve the newly generated id from the database
		foreach ($dbh->query($query) as $row);{
		if($row['title'] == $_REQUEST['title']) {
			$bulid = $row['id'];
			echo "$bulid";
		}
		}
		
		$sqlmem = "INSERT INTO mem_bul (memid, bulid) VALUES ('$_SESSION[id]', $bulid)"; //table connecting which member added
		//which notice, for use on "my profile" page
		$dbh->exec($sqlmem);
	
		header("Location: bulletin.php?result=submitted");
	}
	else
		header("Location: addnotice.php?result=notsubmitted");// in case it didn't work - e.g. if database is not writeable
}
if ($_REQUEST['submit'] == "Insert New Entry")
{
	$expirydate = "$_REQUEST[exyear]-$_REQUEST[exmonth]-$_REQUEST[exday]";	
	include("upload_file_bulletin.php");
	$sql = "INSERT INTO bulletin (title, description, image, type, contact1, contact2, expirydate) VALUES 
	('$_REQUEST[title]', '$_REQUEST[description]', '$newFullName', '$_REQUEST[type]', '$_REQUEST[contact1]',
	 '$_REQUEST[contact2]', '$expirydate')";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	
	if ($dbh->exec($sql)){
		$query = "SELECT id, title FROM bulletin"; //Retrieve the newly generated id from the database
		foreach ($dbh->query($query) as $row);{
		if($row['title'] == $_REQUEST['title']) {
			$bulid = $row['id'];
			echo "$bulid";
		}
		}
		
		$sqlmem = "INSERT INTO mem_bul (memid, bulid) VALUES ('$_SESSION[id]', $bulid)"; //table connecting which member added
		//which notice, for use on "my profile" page
		$dbh->exec($sqlmem);
	
		header("Location: editbulletin.php?result=submitted");
	}
	else
		header("Location: editbulletin.php?result=notsubmitted");// in case it didn't work - e.g. if database is not writeable
}
else if ($_REQUEST['submit'] == "Delete My Notice")
{
	$sql = "DELETE FROM bulletin WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		header("Location: myprofile.php?notice=deleted");
	else
		header("Location: myprofile.php?notice=notdeleted");
}
else if ($_REQUEST['submit'] == "Update My Notice")
{
	$sql = "UPDATE bulletin SET title = '$_REQUEST[title]', description = '$_REQUEST[description]', 
	image= '$_REQUEST[image]', type = '$_REQUEST[type]', contact1 = '$_REQUEST[contact1]', 
	contact2 = '$_REQUEST[contact2]', expirydate = '$_REQUEST[expirydate]' WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		header("Location: myprofile.php?notice=updated");
	else
		header("Location: myprofile.php?notice=notupdated");
}
else if ($_REQUEST['submit'] == "Delete Notice")
{
	$sql = "DELETE FROM bulletin WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		header("Location: editbulletin.php?notice=deleted");
	else
		header("Location: editbulletin.php?notice=notdeleted");
}
else if ($_REQUEST['submit'] == "Update Notice")
{
	$sql = "UPDATE bulletin SET title = '$_REQUEST[title]', description = '$_REQUEST[description]', 
	image= '$_REQUEST[image]', type = '$_REQUEST[type]', contact1 = '$_REQUEST[contact1]', 
	contact2 = '$_REQUEST[contact2]', expirydate = '$_REQUEST[expirydate]' WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql))
		header("Location: editbulletin.php?notice=updated");
	else
		header("Location: editbulletin.php?notice=notupdated");
}
else {
	echo "This page did not come from a valid form submission.<br />\n";
}
echo "</strong></p>\n";

// Basic select and display all contents from table 

echo "<h2>Bulletins in Database Now</h2>\n";
$sql = "SELECT * FROM bulletin";
$result = $dbh->query($sql);
$resultCopy = $result;

if ($debugOn) {
	echo "<pre>";	
// one row at a time:
/*	$row = $result->fetch(PDO::FETCH_ASSOC);
	print_r($row);
	echo "<br />\n";
	$row = $result->fetch(PDO::FETCH_ASSOC);
	print_r($row);
*/
// all rows in one associative array
	$rows = $result->fetchall(PDO::FETCH_ASSOC);
	echo count($rows) . " records in table<br />\n";
	print_r($rows);
	echo "</pre>";
	echo "<br />\n";
}
//foreach ($dbh->query($sql) as $row)
//{
//	print $row[name] .' - '. $row[phone] . "<br />\n";
//}

// close the database connection 
$dbh = null;
?>
<p><a href="addnotice.php">Return to database test page</a></p>
</body>
</html>