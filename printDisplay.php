<?php

include_once('classes/db.php');
include_once('year_semester.php');

$db = new dbConnection();

$query = $db->dbQuery("SELECT * FROM Projects WHERE Year='{$_GET['year']}' AND Semester='{$_GET['term']}' AND Section='{$_GET['section']}'");
$projects = array();
while ($row = mysql_fetch_array($query))
	$projects[] = $row;
?>

<html>
<head><title>IPRO Course Listings</title>
<style>
	body {
	width: 600px;
	margin: 0px auto;
	font-family:Verdana,Arial,Sans-Serif;
	font-size:.8em;
	color:#666;
	margin-top: 20px;
}
</style>

<script language="JavaScript1.2">
function init() {
        if(window.print)
                window.print();
        else
                alert("Please select Print from the file menu");
}
</script>

</head>
<body onload="init()">

<?php

foreach ($projects as $proj) {
				$section = str_replace(' ', '+', $proj['Section']);
				print "</b><h2><a name='{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'>{$proj['Section']}: {$proj['Title']}</h2>";
				print "<p><b>Meeting Days/Time:</b><br />{$proj['DateTime']}</p>";
				print "<p><b>Sponsor: </b><br />{$proj['Sponsor']}</p>";
				print "<p><b>Faculty: </b><br />{$proj['Faculty']}</p>";
				print "<p><b>Appropriate Disciplines:</b><br /> {$proj['Disciplines']}</p>";
				if ($proj['VideoLink'])
				print "<p><b>Presentation Video:<br /></b> <a href='{$proj['VideoLink']}'>Click to View</a></p>";
				print "<p><b>Description:</b><br /> {$proj['Description']}</p>";
}

?>

</body>
</html>
