<?php
/* Template Name: Project Listings - Future
*/ 

/**
 * @package WordPress
 * @subpackage IPRO Theme
 */
include_once('functions.php');
include_once('header.php');
include_once('display_year_semester.php');

include_once('classes/db.php');

if(!function_exists('searchAndReplace'))
{
        function searchAndReplace($arr)
        {
                if(!is_array($arr))
                        return false;
                foreach($arr as $key => $val)
                {
                        if(!is_numeric($val))
                        {
                                $search = array('&', '<P>', '</P>', '<B>', '</B>', '<I>', '</I>', '<B/>', '<I/>', '<OL>', '<UL>', '</UL>', '</OL>', '<LI>', '</LI>', "\n", "\r", '  ', '> <');
                                $replace = array('&amp;', '<br /><br />', '', '<b>', '</b>', '<i>', '</i>', '<b>', '<i>', '<ol>', '<ul>', '</ul>', '</ol>', '<li>', '</li>', '', '', ' ', '><');
                                $arr[$key] = str_replace($search, $replace, $val);
                                $arr[$key] = str_replace('</li>', '', $arr[$key]);
                                $arr[$key] = str_replace('<li>', '</li><li>', $arr[$key]);
                                $search = array('<i><b>', '</b></i>', '<ol></li><li>', '<ul></li><li>', '</ol>', '</ul>');
                                $replace = array('<b><i>', '</i></b>', '<ol><li>', '<ul><li>', '</li></ol>', '</li></ul>');
                                $arr[$key] = str_replace($search, $replace, $arr[$key]);
                        }
                }
                return $arr;
        }
}
?>

<div id="content">

<div id="main">

<?php

$db = dbConnect();
if (isset($_POST['search'])) {
	$sql = $db->prepare("SELECT * FROM Projects WHERE Section IS NOT NULL AND Section LIKE ? AND Semester LIKE ? AND Year LIKE ? AND Title LIKE ? AND Faculty LIKE ? AND Description LIKE ? AND Disciplines LIKE ? ORDER BY Year DESC");
	if ($_POST['section'] == '')
		$_POST['section']="%";
	if ($_POST['term'] == '')
		$_POST['term']="%";
	if ($_POST['year'] == '')
		$_POST['year']="%";
	if ($_POST['title'] == '')
		$_POST['title']="%";
	if ($_POST['faculty'] == '')
		$_POST['faculty']="%";
	if ($_POST['description'] == '')
                $_POST['description']="%";
	if ($_POST['disciplines'] == '')
                $_POST['disciplines']="%";

	$sql->bind_param("sssssss",$_POST['section'],$_POST['term'],$_POST['year'],$_POST['title'],$_POST['faculty'],$_POST['description'],$_POST['disciplines']);
	$sql->execute();
	$qres = $sql->get_result();

	$resultSet = array();
	while ($result = $qres->fetch_assoc())
		$resultSet[] = searchAndReplace($result);
	$qres->close();
	$query->close();
}

?>

<h2>IPRO Course Listings</h2>

<?php

if (count($resultSet) == 0) {
	echo "Your search produced no results.";
}

else {

?>

<table border="0" width="600" cellspacing="0" cellpadding="0" bgcolor="#F7FBFB">
<tr><td height="50" colspan="2" align="left" bgcolor="#F7FBFB"><font size="4" face="Arial" ><b>Search for 
Projects</b></font></td></tr>

<?php
foreach ($resultSet as $proj) {
	$sect = str_replace(' ', '+', $proj['Section']);
        echo "<tr><td colspan=\"2\"><table width=\"100%\"><tr><td valign=\"top\" bgcolor=\"#FFFFFF\" width=\"30\"><font size=\"2\" color=\"#000000\">{$proj['Semester']}&nbsp;{$proj['Year']}&nbsp;-&nbsp;</font></td><td valign=\"top\" bgcolor=\"#FFFFFF\" width=\"80\"><a href=\"#{$proj['Semester']}{$proj['Year']}_{$sect}\">{$proj['Section']}</a></td><td valign=\"top\" bgcolor=\"#FFFFFF\"><font face=\"Arial\" size=\"2\" color=\"#000000\">{$proj['Title']}</font></td></tr></table></td></tr>\n";
}

echo "<tr><td>&nbsp;</td></tr>\n";

foreach ($resultSet as $result) {
	$section = str_replace(' ', '+', $result['Section']);
	echo "<tr>\n";
	echo "<td style=\"width: 50px; color: #8C0A37\"><a name=\"{$result['Semester']}{$result['Year']}_{$section}\">Section:</a></td><td width=\"500\">{$result['Section']}</td></tr>\n";
	echo "<tr><td style=\"vertical-align: top; width: 50px; color: #8C0A37\">Semester:</td><td valign=\"top\" width=\"500\">{$result['Semester']}</td></tr>\n";
	echo "<tr><td style=\"vertical-align: top; width: 50px; color: #8C0A37\">Year:</td><td valign=\"top\" width=\"500\">{$result['Year']}</td></tr>\n";
	echo "<tr><td style=\"vertical-align: top; width: 50px; color: #8C0A37\">Title:</td><td valign=\"top\" width=\"500\">{$result['Title']}</td></tr>\n";
	echo "<tr><td style=\"vertical-align: top; width: 50px; color: #8C0A37\">Days/Time:</td><td valign=\"top\" width=\"500\">{$result['DateTime']}</td></tr>\n";
	echo "<tr><td style=\"vertical-align: top; width: 50px; color: #8C0A37\">Faculty:</td><td valign=\"top\" width=\"500\">{$result['Faculty']}</td></tr>\n";
	echo "<tr><td style=\"vertical-align: top; width: 50px; color: #8C0A37\">Sponsor:</td><td valign=\"top\" width=\"500\">{$result['Sponsor']}</td></tr>\n";
	echo "<tr><td style=\"vertical-align: top; width: 50px; color: #8C0A37\">Disciplines:</td><td valign=\"top\" width=\"500\">{$result['Disciplines']}</td></tr>\n";
	echo "<tr><td style=\"vertical-align: top; width: 50px; color: #8C0A37\">Description:</td><td valign=\"top\" width=\"500\">{$result['Description']}</td></tr>\n";
	echo "<tr><td valign=\"top\" width=\"600\" colspan=\"3\">&nbsp;</td></tr>\n";
}
?>

</table>

<?php

}

?>
</div>

<?php get_sidebar('courses'); ?>
<?php get_footer(); ?>


