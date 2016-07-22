<?php
/* Template Name: Course Listings Landing Redirect
*/ 

/**
 * @package WordPress
 * @subpackage IPRO Theme
 */
include_once('display_year_semester.php');
include_once('classes/db.php');
$db = dbConnect();
$query = $db->prepare("SELECT * FROM Projects WHERE Year=? AND Semester=? ORDER BY Section");
$query->bind_param("ss",$nextYear,$nextTerm);
$query->execute();
$qres = $query->get_result();
$rows = $qres->num_rows;
$qres->close();
$query->close();


$url = '/project-listings/'.($rows ? 'future-projects' : 'current-projects');

header("Location: $url");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en"><head>
<title>Redirect</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head><body>
<p>Redirecting to <a href="<?php echo $url; ?>"><?php echo $url; ?></a></p>
</body></html>
