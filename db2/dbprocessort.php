<?php
/* This code runs the SQL queries and outputs what happens as a result of the queries.
   It would be possible to have this code set messages in a session variable and pass this on to another page 
   (redirect with the header method) instead of printing the results here. 
   The X option demonstrates this ("silent" delete).
*/
include("dbconnect.php");
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php

if ($_REQUEST['submit'] == "Filter"){
	header("Location: currentartists.php?filter=$_REQUEST[filterby]");	
}

elseif ($_REQUEST['submit'] == "Remove Filter"){
	header("Location: currentartists.php");	
}
else
echo "something is wrong";

?>

</body>
</html>