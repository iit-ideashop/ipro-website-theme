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
$db = dbConnect();

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
$query = $db->prepare("SELECT * FROM Projects WHERE Year=? AND Semester=? ORDER BY Section");
$query->bind_param("ss",$currentYear,$currentTerm);
$query->execute();
$qres = $query->get_result();

$projects = array();
while ($row = $qres->fetch_assoc())
{
	$projects[] = searchAndReplace($row);
}
$qres->close();
?>

<div id="content">

<div id="main">

<div class="domtab">
	<ul class="domtabs">
		<li><a href="/project-listings/current-projects"><strong>Current Projects</strong></a></li>
		<li class="active"><a href=""><strong>Future Projects</strong></a></li>
		<li><a href="/project-listings/search-projects"><strong>Search Projects</strong></a></li>
	</ul>
		<div>


<a name='top'></a>

<h1>IPRO Future Listings for <?php if ($nextTerm == 'Summer') {print "Summer $nextYear and Fall $nextYear";} else {print "$nextTerm $nextYear";} ?></h1>
       	 

<?php
			$query->bind_param("ss",$nextYear,$nextTerm);
			$query->execute();
			$qres = $query->get_result();

			if ($nextTerm == 'Summer')
			{
				$query->bind_param("ss",$nextYear,"Fall");
				$query->execute();
				$fallq = $query->get_result();

				$fallProjects = array();
				while($row = $fallq->fetch_assoc())
					$fallProjects[] = searchAndReplace($row);
			$fallq->close();	
			}
			$projects = array();
			while ($row = $qres->fetch_assoc())
				$projects[] = searchAndReplace($row);
				
			$query->close();
			$qres->close();
			if (count($projects) == 0)
				print "<h4>There are no projects listed as of yet for the next term. Please check back at a later time.</h4>\n";
			if(isset($fallProjects))
			{
				echo "<p>Skip to:</p>\n<ul>\n";
				echo "<li><a href=\"#projlist1\">Summer $nextYear</a></li>\n";
				echo "<li><a href=\"#projlist2\">Fall $nextYear</a></li>\n</ul>\n";
			}
?>
			<!--PROJECTS LISTING-->
			<a name="projlist1"></a>
			<table id="projlist1">
			<?php
			echo "<tr class=\"term1\"><th>$nextTerm $nextYear</th></tr>\n";
			foreach ($projects as $proj) {
				print	"<tr class=\"term1\">
						<td><a href='#{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'><b>IPRO {$proj['Section']}</b><br /> {$proj['Title']}</a></td>
						</tr>\n";
			}
			if(isset($fallProjects))
			{
				//echo "<tr class=\"term2\"><th>Fall $nextYear</th></tr>\n";
				//foreach ($fallProjects as $proj) {
                                //	print   "<tr class=\"term2\">
                                //                <td><a href='#{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'><b>IPRO {$proj['Section']}</b><br /> {$proj['Title']}</a></td>
                                //                </tr>\n";
	                        //}
			}
			?>
			</table>
			
			<!--DESCRIPTIONS OF THE PROJECTS-->
			<?php
			if(isset($fallProjects))
				echo "<div class=\"term1\"><h1>Summer $nextYear</h1>\n";
			foreach ($projects as $proj) {
				$section = str_replace(' ', '+', $proj['Section']);
				print "<h2><a name='{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'>{$proj['Section']}: {$proj['Title']}</a></h2>
				<div><a href='javascript:void(window.open(\"/wp-content/themes/ipro/printDisplay.php?section=$section&amp;term={$proj['Semester']}&amp;year={$proj['Year']}\"))'>print</a> | <a href='#top'> return to top</a>";
				if(isset($fallProjects))
					echo " | <a href=\"#projlist1\"> return to summer listing</a>";
				echo "</div>\n";
				print "<h4>Semester:</h4>{$proj['Semester']} $nextYear\n";
				print "<h4>Meeting Days/Time:</h4>{$proj['DateTime']}\n";
				print "<h4>Sponsor: </h4>{$proj['Sponsor']}\n";
				print "<h4>Faculty: </h4>{$proj['Faculty']}\n";
				print "<h4>Appropriate Disciplines:</h4> {$proj['Disciplines']}\n";
				if ($proj['VideoLink'])
					print "<h4>Presentation Video:</h4> <a href='{$proj['VideoLink']}'>Click to View</a>\n";
				print "<h4>Description:</h4> <div style='font-size:.8em;'>{$proj['Description']}</div>\n";
				//print "</b>";
			}
			if(isset($fallProjects))
			{
				echo "</div><a name=\"projlist2\"></a><table>\n";
				echo "<tr class=\"term2\"><th>Fall $nextYear</th></tr>\n";
				foreach ($fallProjects as $proj) {
					print	"<tr class=\"term2\">
                                                <td><a href='#{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'><b>IPRO {$proj['Section']}</b><br /> {$proj['Title']}</a></td></tr>\n";
				}
				echo "</table><div class=\"term2\"><h1>Fall $nextYear</h1>\n";
				foreach ($fallProjects as $proj) {
	                                $section = str_replace(' ', '+', $proj['Section']);
        	                        print "<h2><a name='{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'>{$proj['Section']}: {$proj['Title']}</a></h2>
					<div><a href='javascript:void(window.open(\"/wp-content/themes/ipro/printDisplay.php?section=$section&amp;term={$proj['Semester']}&amp;year={$proj['Year']}\"))'>print</a> | <a href='#top'> return to top</a> | <a href=\"#projlist2\"> return to fall listing</a></div>";
					print "<h4>Semester:</h4>{$proj['Semester']} $nextYear\n";
	                                print "<h4>Meeting Days/Time:</h4>{$proj['DateTime']}\n";
        	                        print "<h4>Sponsor: </h4>{$proj['Sponsor']}\n";
                	                print "<h4>Faculty: </h4>{$proj['Faculty']}\n";
                        	        print "<h4>Appropriate Disciplines:</h4> {$proj['Disciplines']}\n";
                                	if ($proj['VideoLink'])
		                                print "<h4>Presentation Video:</h4> <a href='{$proj['VideoLink']}'>Click to View</a>\n";
        	                        print "<h4>Description:</h4> <div style='font-size:.8em;'>{$proj['Description']}</div>\n";
                	                //print "</b>";
				}
				echo "</div>\n";
			}
?>


</div></div>
</div>

<?php get_sidebar('futurecourses'); ?>
<?php get_footer(); ?>
