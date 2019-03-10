<?php

// load posts having 'deadline-date' meta_key
// and have date set on today or future (no upper limit)
$args = array(
	'meta_key'				=> 'deadline-date',
	'meta_value'			=> date( "Ymd" ),
	'meta_compare'		=> '>=',
	'ignore_sticky_posts' => 1,
	'posts_per_page'	=> -1
);
$the_query = new WP_Query($args);

// render container markup
if ( $the_query->have_posts() ) :
?>
	<div id="agenda-container">
	<div id="agenda-list-wrap">
		<div class="day-segment">
			<div id="agenda-line"></div>
<?php

class planedAction {
	public $date;
	public $title;
	public $link;
	public $dateValue;
}

$plannedActionsArray = array();
$today = date('Ymd');

while ( $the_query->have_posts() ) : $the_query->the_post();

	$metaDate = get_post_meta( get_the_ID(), $key = 'deadline-date', $single = true );
	$metaHrmnTitle = get_post_meta( get_the_ID(), $key = 'harmonogram-title', $single = true );

	if ($today <= $metaDate) {

		$newAction = new planedAction();
		$newAction->date = $metaDate;
		if ( $metaHrmnTitle !== "" )
		{
			$newAction->title = $metaHrmnTitle;
		} else 
		{
			$newAction->title = get_the_title();
		}
		$newAction->link = get_the_permalink();

		array_push($plannedActionsArray, $newAction);

	}

endwhile;
//print_r($plannedActionsArray);

// TODO - order by planedAction->date
function sortPlannedActionsByDateValue() {
	global $plannedActionsArray;
	$n = count($plannedActionsArray);
	//echo "array length: {$n}<br>";

	do {

		$swapped = 0;

		$i = 1;
		while ( $i < $n ) {

			//echo "{$plannedActionsArray[$i - 1]->dateValue} > {$plannedActionsArray[$i]->dateValue}<br>";

			if (($plannedActionsArray[$i - 1]->date) > ($plannedActionsArray[$i]->date)) {
				//swap
				$tmp = $plannedActionsArray[$i - 1];
				$plannedActionsArray[$i - 1] = $plannedActionsArray[$i];
				$plannedActionsArray[$i] = $tmp;
				
				//echo "swapped<br>";
				$swapped = 1;	
			} else {
				//echo "not swapped<br>";
			}

			//echo "i = $i<br>";
			$i += 1;

		}

	} while ($swapped === 1);
}
sortPlannedActionsByDateValue();

$usedDatesArr = array();
foreach ($plannedActionsArray as $planedAction) {

	//echo $planedAction->date . "<br />";

	list($day, $month, $year) = explode("-", date("d-m-Y", strtotime($planedAction->date)) );

	//echo "day: " . $day . ", month: " . $month . ", year: " . $year;
	
	$month = ltrim($month, '0');
	$day = ltrim($day, '0');
	$months = array('ledna', 'února', 'března', 'dubna', 'května', 'června', 'července', 'srpna', 'září', 'října', 'listopadu', 'prosince');
	$month = $months[$month - 1];

	if (!in_array($planedAction->date, $usedDatesArr)){
		array_push($usedDatesArr, $planedAction->date);

		if ($usedDatesArr !== array()) {
			echo "</ul>";
		}

		?>

		<div class="date-label"><?php echo "$day. $month";?></div>
		<ul class="event-list">

		<?php
	}

	?>

		<li class="event"><div class="dot"></div><a href="<?php echo $planedAction->link; ?>"><?php echo $planedAction->title; ?></a></li>
	
	<?php

}

wp_reset_postdata();
?>
	
		</div>
	</div>
	</div>

<?php
else :
	echo "<!--didn't find any post with meta-key matching \"deadline-date\"-->";
endif;

?>