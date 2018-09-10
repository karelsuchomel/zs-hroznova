<?php
$heroImageFolderURL = get_bloginfo('template_directory') . "/assets/images/hero-card/";

// return: night, sunrize, noon, sunset
function getPartOfTheDay ()
{
	// get times of sunset, sunrize, and twilights
	$sun_info = date_sun_info( time(), 49.1939, 16.5711);

	date_default_timezone_set("Europe/Prague");
	$sunrizeTwilightTime = date("His", $sun_info['civil_twilight_begin']);
	$sunrizeTime = date("His", $sun_info['sunrise']);
	$sunsetTime = date("His", $sun_info['sunset']);
	$sunsetTwilightTime = date("His", $sun_info['civil_twilight_end']);

	$currentTime = date("His");
	if ( $currentTime > $sunsetTwilightTime || $currentTime < $sunrizeTwilightTime ) {
		return "night";
	} elseif ( $currentTime >= $sunrizeTwilightTime && $currentTime <= $sunrizeTime ) {
		return "sunrize";
	} elseif ( $currentTime > $sunrizeTime && $currentTime < $sunsetTime ) {
		return "noon";
	} elseif ( $currentTime >= $sunsetTime && $currentTime <= $sunsetTwilightTime ) {
		return "sunset";
	} else {
		return false;
	}
}

function getInfoCardImageName () 
{
	global $heroImageFolderURL;

	return $heroImageFolderURL . "school-noon";
}

?>

<div id="info-card-wrap" class="clear-both">
	<div id="hero-image">
		
		<picture>
			<source 
				media="(min-width: 571px)"
				srcset="<?php echo getInfoCardImageName() . "-960w.png";?> 960w,
								<?php echo getInfoCardImageName() . "-1920w.png";?> 1920w
								"/>
			<source 
				media="(max-width: 570px)"
				srcset="<?php echo getInfoCardImageName() . "-360w.png";?> 360w,
								<?php echo getInfoCardImageName() . "-720w.png";?> 720w
								"/>
			<img class="image-container" src="<?php echo getInfoCardImageName() . "-960w.png";?>">
		</picture>
	</div>
</div>