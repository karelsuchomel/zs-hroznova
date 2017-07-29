<?php
// functions for infocard picute (sunrize, noon, sunset, night)

function getInfoCardImage () 
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
    return "info-card-night.png";
  } elseif ( $currentTime >= $sunrizeTwilightTime && $currentTime <= $sunrizeTime ) {
    return "info-card-sunrize.png";
  } elseif ( $currentTime > $sunrizeTime && $currentTime < $sunsetTime ) {
    return "info-card-noon.png";
  } elseif ( $currentTime >= $sunsetTime && $currentTime <= $sunsetTwilightTime ) {
    return "info-card-sunset.png";
  } else {
    return false;
  }
}

?>

<div id="info-card-wrap" class="clear-both"
<?php
if (!(isset($_COOKIE["info-card-closed"])) || $_COOKIE["info-card-closed"] == "FALSE" ) {
?>style="display: block"<?php } ?>>
  <div id="hide-info-card">
    Schovat
    <img src="<?php bloginfo('template_directory'); ?>/assets/images/arrow-up-icon.svg">
  </div>
  <div id="hero-image">
    
    <div class="image-container" style="background-image: url('<?php

    echo bloginfo('template_directory') . "/assets/images/" . getInfoCardImage();

    ?>');"></div>
    <h1>Vítejte na stránkách Základní&nbsp;školy Brno, Hroznová&nbsp;1</h1>
  </div>
  <div class="basic-info-wrap clear-both">
    <div class="info-block">
      <h2>Kontakt</h2>
      <ul>
        <li><a href="mailto:&#118;&#101;&#100;&#101;&#110;&#105;&#064;&#122;&#115;&#104;&#114;&#111;&#122;&#110;&#111;&#118;&#097;&#046;&#099;&#122;">&#118;&#101;&#100;&#101;&#110;&#105;&#064;&#122;&#115;&#104;&#114;&#111;&#122;&#110;&#111;&#118;&#097;&#046;&#099;&#122;</a></li>
        <li>+420 543 211 912 </li>
      </ul>
    </div>
    <hr>
    <div class="info-block">
      <h2>E-podatelna</h2>
    	<ul>
    		<li><a href="mailto:&#112;&#111;&#100;&#097;&#116;&#101;&#108;&#110;&#097;&#064;&#122;&#115;&#104;&#114;&#111;&#122;&#110;&#111;&#118;&#097;&#046;&#099;&#122;">&#112;&#111;&#100;&#097;&#116;&#101;&#108;&#110;&#097;&#064;&#122;&#115;&#104;&#114;&#111;&#122;&#110;&#111;&#118;&#097;&#046;&#099;&#122;</a></li>
    		<li>Datová schránka: 3nxmjxs</li>
    	</ul>
    </div>
    <hr>
    <div class="info-block small-screen-display-none">
      <h2>Adresa</h2>
      <ul>
        <li>Hroznová 1, <br class="display-none-640">603 00 Brno</li>
        <li><a href="https://www.google.cz/maps/place/Z%C3%A1kladn%C3%AD+%C5%A1kola+Brno,+Hroznov%C3%A1+1,+p%C5%99%C3%ADsp%C4%9Bvkov%C3%A1+organizace/@49.1938391,16.5707481,19z/data=!4m13!1m7!3m6!1s0x4712942d8048d0eb:0x5009e29bfbce85!2zSHJvem5vdsOhIDY1LzEsIDYwMyAwMCBCcm5vLXN0xZllZC1QaXPDoXJreQ!3b1!8m2!3d49.1939583!4d16.5711638!3m4!1s0x0:0x9db2cad388ef8fe7!8m2!3d49.1939002!4d16.5711587" target="_blank">zobrazit na mapě</a></li>
      </ul>
    </div>
  </div>
</div>