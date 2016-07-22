<?php
/* Template Name: Project Listings - Search
*/ 

/**
 * @package WordPress
 * @subpackage IPRO Theme
 */
include_once('functions.php');
include_once('header.php');
include_once('year_semester.php');

include_once('classes/db.php');
$db = dbConnect();
$query = $db->prepare("SELECT * FROM Projects WHERE Year=? AND Semester=? ORDER BY Section");
$query->bind_param("ss",$currentYear,$currentTerm);
$query->execute();
$qres = $query->get_result();

$projects = array();
while ($row = $qres->fetch_assoc())
	$projects[] = $row;
$query->close();
$qres->close();
?>

<div id="content">

<div id="main">

<div class="domtab">
	<ul class="domtabs">
		<li><a href="/project-listings/current-projects"><strong>Current Projects</strong></a></li>
		<li><a href="/project-listings/future-projects"><strong>Future Projects</strong></a></li>
		<li class="active"><a href=""><strong>Search Projects</strong></a></li>
	</ul>
		<div>


<a name="top"></a>

<form action="search-results" method="post">
<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF"> 
	<tr bgcolor="#FFFFFF" valign="top"> 
	<td colspan="2">
        <span class="subheading">Use the form below to search for a particular IPRO Project.</span><br />&nbsp;
	</td>
	</tr>
	<tr><td><label for="courseyear">Year</label></td><td><select name="courseyear" id="courseyear">
<?php
	foreach($years as $year) {
		if ($year == $currentYear)
			echo "<option value=\"$year\" selected=\"selected\">$year</option>\n";
		else
			echo "<option value=\"$year\">$year</option>\n";
	}
?>
	</select></td></tr>
	<tr><td><label for="term">Semester</label></td><td><select name="term" id="term">
<?php
	foreach($terms as $term) {
		if ($term == $currentTerm)
			echo "<option value=\"$term\" selected=\"selected\">$term</option>\n";
		else
			echo "<option value=\"$term\">$term</option>";
	}
?>
	</select></td></tr>
	<tr><td><label for="section">Section</label></td><td><input type="text" name="section" size="30" id="section" /></td></tr>
	<tr><td><label for="title">Title</label></td><td><input type="text" name="title" size="30" id="title" /></td></tr>
	<tr><td><label for="sponsor">Sponsor</label></td><td><input type="text" name="sponsor" size="30" id="sponsor" /></td></tr>
	<tr><td><label for="faculty">Faculty</label></td><td><input type="text" name="faculty" size="30" id="faculty" /></td></tr>
	<tr><td><label for="disciplines">Suggested Disciplines</label></td><td><select name="disciplines" id="disciplines"><option value=""></option>
<?php
	$query = $db->query("SELECT * FROM Disciplines");
	$disciplines = array();
	while ($row = $query->fetch_row())
		$disciplines[] = str_replace('&', '&amp;', $row[0]);
	foreach ($disciplines as $discipline)
		echo "<option value=\"$discipline\">$discipline</option>\n";
?>
	</select></td></tr>
	<tr><td><label for="description">Description</label></td><td><input type="text" name="description" id="description" size="30" /></td></tr>
	<tr><td><input type="submit" value="Submit" class="buttonRegular" onmouseover="this.className='buttonRegularFocus'" onmouseout="this.className='buttonRegular'" name="Submit" /></td></tr>
</table>
<input type="hidden" name="search" value="true" />
</form>


</div></div>
</div>

<?php get_sidebar('courses'); ?>
<?php get_footer(); ?>
