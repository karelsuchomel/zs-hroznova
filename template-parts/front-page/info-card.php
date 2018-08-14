<?php
// functions for infocard picute (sunrize, noon, sunset, night)

function getInfoCardImage () 
{

  // TODO delete following!!!
  return "960x342-noon-new-export.png";

  // get times of sunset, sunrize, and twilights
  $sun_info = date_sun_info( time(), 49.1939, 16.5711);

  date_default_timezone_set("Europe/Prague");
  $sunrizeTwilightTime = date("His", $sun_info['civil_twilight_begin']);
  $sunrizeTime = date("His", $sun_info['sunrise']);
  $sunsetTime = date("His", $sun_info['sunset']);
  $sunsetTwilightTime = date("His", $sun_info['civil_twilight_end']);

  $currentTime = date("His");
  if ( $currentTime > $sunsetTwilightTime || $currentTime < $sunrizeTwilightTime ) {
    return "info-card-night.png";
  } elseif ( $currentTime >= $sunrizeTwilightTime && $currentTime <= $sunrizeTime ) {
    return "info-card-sunrize.png";
  } elseif ( $currentTime > $sunrizeTime && $currentTime < $sunsetTime ) {
    return "960x342-noon-new-export.png";
  } elseif ( $currentTime >= $sunsetTime && $currentTime <= $sunsetTwilightTime ) {
    return "info-card-sunset.png";
  } else {
    return false;
  }
}

?>

<div id="info-card-wrap" class="clear-both">
  <div id="hero-image">
    
    <div class="image-container" style="background-image: url('<?php

    echo bloginfo('template_directory') . "/assets/images/" . getInfoCardImage();

    ?>');"></div>
    <!-- <h1>Vítejte na stránkách Základní&nbsp;školy Brno, Hroznová&nbsp;1</h1> -->
  </div>
</div>