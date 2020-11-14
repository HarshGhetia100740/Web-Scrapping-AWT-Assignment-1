<?php
include('simple_html_dom.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "harshawt";
$z = 1;
for ($x = 1; $x <= 3; $x++) //For Fetching 3 Pages '$x <= 3', You can Toggle This Value for More than 3 Pages
{
	$target_url = 'https://moviesverse.com/page/'.$z.'/';
	$html = new simple_html_dom();
	$html->load_file($target_url);
	foreach($html->find("div[id=content_box]") as $link)
	{
		for($i = 0; $i < 20; $i++)
		{
			$item['movieThumbnail'] = $link->find("img", $i)->src;
			$movieThumbnail = html_entity_decode(trim($item['movieThumbnail']));
			$item['movieName'] = $link->find("h2", $i)->plaintext;
			$movieName = html_entity_decode(trim($item['movieName']));
			$lastMovieName = substr($movieName, 0, strpos($movieName, ")"));
			$finalMovieName = str_replace('Download', '', $lastMovieName);
			echo '<img src="'.$movieThumbnail.'"/><br>';
			$finalMovieName = $finalMovieName.")";
			echo "<h3>Fetched Movie Name: </h3>".$movieName."<br>";
			echo "<h3>Scraped Movie Name: </h3>".$finalMovieName."<br>";
			$lastMovieDesc = strstr($movieName, '720');
			$finalMovieDesc = $lastMovieDesc;
			echo "<h3>Scraped Movie Description: </h3>".$finalMovieDesc."<br>";
			echo "<br>";

			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error)
			{
				die("Connection Failed: " . $conn->connect_error);
			}
			$sql = "INSERT INTO wp_fetchdata_harsh (moviename, moviethumbnail, moviedesc) VALUES ('$finalMovieName', '$movieThumbnail', '$finalMovieDesc')";
			if ($conn->query($sql) === TRUE)
			{
				echo "Record Inserted Successfully!<br>";
			}
			else
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
		}
	$z++;
	}
}
?>
