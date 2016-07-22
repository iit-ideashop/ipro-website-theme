<?php



/* Template Name: Course Listings
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
$query->close();

?>

<div id="content">

<div id="main">

<div class="domtab">
	<ul class="domtabs">
		<li class="active"><a href=""><strong>Current Projects</strong></a></li>
		<li><a href="/project-listings/future-projects"><strong>Future Projects</strong></a></li>
		<li><a href="/project-listings/search-projects"><strong>Search Projects</strong></a></li>
	</ul>
<div>

<!--<h3>Instructions for Enrollment (UNCOMMENT WHEN DONE!!!)</h3>-->
		<?php
        $query = $db->query("SELECT * FROM Instructions");
        $inst = $query->fetch_row();
        print "<a name='instructions'></a><p>{$inst[0]}</pZ><br><br>";
		?>

<a name='top'></a>

          <h1>IPRO Current Listings for <?php print "$currentTerm $currentYear"; ?></h1>
			<!--PROJECTS LISTING-->
			<table>
			<?php
			foreach ($projects as $projkey => $proj) {
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
				print "<h2><a name='{$proj['Semester']}{$proj['Year']}_{$proj['Section']}'>{$proj['Section']}: {$proj['Title']}</a></h2>
				<span><a href='javascript:void(window.open(\"/wp-content/themes/ipro/printDisplay.php?section=$section&amp;term={$proj['Semester']}&amp;year={$proj['Year']}\"))'>print</a> | <a href='#top'>return to top</a></span>";
				print "<h4>Meeting Days/Time:</h4>{$proj['DateTime']}";
				print "<h4>Sponsor: </h4>{$proj['Sponsor']}";
				print "<h4>Faculty: </h4>{$proj['Faculty']}";
				print "<h4>Appropriate Disciplines:</h4> {$proj['Disciplines']}";
				if ($proj['VideoLink'])
				print "<h4>Presentation Video:</h4> <a href='{$proj['VideoLink']}'>Click to View</a>";
				print "<h4>Description:</h4> {$proj['Description']}";
				print "<a href='#top'>return to top</a>";
				
			}
			?>



</div></div>
</div>

<?php get_sidebar('courses'); ?>
<?php get_footer(); ?>
