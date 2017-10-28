<?php

// load posts maximum 1-2 years old
if(date('n') < 9){
	$preYear = date('Y') - 1;
} else {
	$preYear = date('Y');
}
$args = array(
	'date_query' => array(
		array(
			'after'     => array(
				'year'  => $preYear,
				'month' => 9,
				'day'   => 1,
			),
			'inclusive' => true,
		),
	),
	'orderby' => 'date',
	'order' => 'ASC',
);
$the_query = new WP_Query($args);



if ( $the_query->have_posts() ) :
?>

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

	/*
	?> post - ID: <?php echo get_the_ID(); ?> <br> <?php
	*/

	$metaDate = get_post_meta( get_the_ID(), $key = 'deadline-date', $single = true );
	$metaHrmnTitle = get_post_meta( get_the_ID(), $key = 'harmonogram-title', $single = true );

	if (isset($metaDate)) {

		list($day, $month, $year) = explode("/", $metaDate);
		$dateValueHolder = $year . $month . $day;

		if (!($today > $dateValueHolder)) {

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
			$newAction->dateValue = $dateValueHolder;

			array_push($plannedActionsArray, $newAction);

		}

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

			if (($plannedActionsArray[$i - 1]->dateValue) > ($plannedActionsArray[$i]->dateValue)) {
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

	list($day, $month, $year) = explode("/", $planedAction->date);

	
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

		<div class="date-label"><?php echo "$day. $month";?><div class="dot"></div></div>
		<ul class="event-list">

		<?php
	}

	?>

		<li class="event"><a href="<?php echo $planedAction->link; ?>"><?php echo $planedAction->title; ?></a></li>
	
	<?php

}

wp_reset_postdata();
?>
	
		</div>
	</div>

<?php
else :
	echo "<!--didn't find any post with meta-key matching \"deadline-date\"-->";
endif;

?>