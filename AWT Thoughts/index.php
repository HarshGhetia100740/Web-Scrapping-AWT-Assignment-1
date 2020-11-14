<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'harshawt';
$conn=mysqli_connect($host,$username,$password,$dbname);
if(!$conn){
 die('Could not Connect My Sql:' .mysql_error());
}

$result = mysqli_query($conn,"SELECT thoughts FROM wp_thoughts ORDER BY RAND() LIMIT 1");

$i=0;
while($row = mysqli_fetch_array($result)) {
	echo "<h2>".$row["thoughts"]."</h2>";
}
?>