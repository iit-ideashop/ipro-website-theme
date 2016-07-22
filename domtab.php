<?php
 /* Template Name: DomTab
*/ 

/**
 * @package WordPress
 * @subpackage Default_Theme
 */
include_once('functions.php');
include_once('header.php');
include_once('display_year_semester.php');

include_once('classes/db.php');
$db = new dbConnection();

$query = $db->dbQuery("SELECT * FROM Projects WHERE Year='$currentYear' AND Semester='$currentTerm' ORDER BY Section");
$projects = array();
while ($row = mysql_fetch_array($query))
	$projects[] = $row;
?>

<div id="content">

<div id="main">

<a name="top"></a> 

<div class="domtab">
	<ul class="domtabs">
		<li><a href="#current_projects"><strong>Current Projects</strong></a></li>
		<li><a href="#future_projects"><strong>Future Projects</strong></a></li>
		<li><a href="#search_projects"><strong>Search Projects</strong></a></li>
	</ul>
	<div>
		<a name="current_projects" id="current_projects"></a>
		
		  
			<h1>IPRO Current Listings for <?php print "$currentTerm $currentYear"; ?></h1>
			
			<!--PROJECTS LISTING-->
			<table>
			<?php
			foreach ($projects as $proj) {
				print	"<tr>
						<td><a href='#{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'><b>IPRO {$proj['Section']}</b><br /> {$proj['Title']}</a></td>
						</tr>";
			}
			?>
			</table>
			
			<!--DESCRIPTIONS OF THE PROJECTS-->
			<?php
			foreach ($projects as $proj) {
				$section = str_replace(' ', '+', $proj['Section']);
				print "</b><h2><a name='{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'>{$proj['Section']}: {$proj['Title']}</h2>
				<span><a href='javascript:void(window.open(\"/wp-content/themes/ipro/printDisplay.php?section=$section&term={$proj['Semester']}&year={$proj['Year']}\"))'>print</a> | <a href='#top'>return to top</a></span>";
				print "<h4>Meeting Days/Time:</h4>{$proj['DateTime']}";
				print "<h4>Sponsor: </h4>{$proj['Sponsor']}";
				print "<h4>Faculty: </h4>{$proj['Faculty']}";
				print "<h4>Appropriate Disciplines:</h4> {$proj['Disciplines']}";
				if ($proj['VideoLink'])
				print "<h4>Presentation Video:</h4> <a href='{$proj['VideoLink']}'>Click to View</a>";
				print "<h4>Description:</h4> <span style='font-size:.8em;'>{$proj['Description']}</span>";
				print "</b><a href='#top'>return to top</a>";
				
			}
?>
		
	</div>
	
	
	<div>
		<a name="future_projects" id="future_projects"></a>
		<h1>IPRO Future Listings for <?php if ($nextTerm == 'Summer') {print "Summer $nextYear and Fall $nextYear";} else {print "$nextTerm $nextYear";} ?></h1>
       	 

<?php
			if ($nextTerm == 'Summer')
				$query = $db->dbQuery("SELECT * FROM Projects WHERE Year='$nextYear' AND (Semester='Summer' OR 
			Semester='Fall') ORDER BY Semester DESC, Section");
			else
				$query = $db->dbQuery("SELECT * FROM Projects WHERE Year='$nextYear' AND Semester='$nextTerm' ORDER BY Section");
			$projects = array();
			while ($row = mysql_fetch_array($query))
				$projects[] = $row;
				
				
			if (count($projects) == 0)
				print "<h4>There are no projects listed as of yet for the next term. Please check back at a later time.</h4>";
?>

			<!--PROJECTS LISTING-->
			<table>
			<?php
			foreach ($projects as $proj) {
				print	"<tr>
						<td><a href='#{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'><b>IPRO {$proj['Section']}</b><br /> {$proj['Title']}</a></td>
						</tr>";
			}
			?>
			</table>
			
			<!--DESCRIPTIONS OF THE PROJECTS-->
			<?php
			foreach ($projects as $proj) {
				$section = str_replace(' ', '+', $proj['Section']);
				print "</b><h2><a name='{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'>{$proj['Section']}: {$proj['Title']}</h2>
				<div><a href='javascript:void(window.open(\"printDisplay.php?section=$section&term={$proj['Semester']}&year={$proj['Year']}\"))'>print</a> | <a href='#top'> return to top</a></div>";
				print "<h4>Meeting Days/Time:</h4>{$proj['DateTime']}";
				print "<h4>Sponsor: </h4>{$proj['Sponsor']}";
				print "<h4>Faculty: </h4>{$proj['Faculty']}";
				print "<h4>Appropriate Disciplines:</h4> {$proj['Disciplines']}";
				if ($proj['VideoLink'])
				print "<h4>Presentation Video:</h4> <a href='{$proj['VideoLink']}'>Click to View</a>";
				print "<h4>Description:</h4> <span style='font-size:.8em;'>{$proj['Description']}</span>";
				print "</b>";
			}				
?>

	</div>
</div>


</div>

<?php get_sidebar('courses'); ?>
<?php get_footer(); ?>
