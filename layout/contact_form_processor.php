<?php
//these keys are different for each domain name.
$publickKeyRecaptcha = '6Lc6iBcTAAAAAI_oJjNuHMXmCnx319L9em1D-e8o';
$secretKeyRecaptcha = '6Lc6iBcTAAAAADzPMlwN1s5SjgXYzoBoGU9JD3Yd';

$nickName;
$headline;
$questionText;

if (isset($_POST['formSended'])) {
  global $nickName, $headline, $questionText;
  $nickName = $_POST['nickName'];
  $headline = $_POST['headline'];
  $questionText = $_POST['question-text'];

  echo $nickName ,", ", $headline ,", ", $questionText;
  validateInput();
}

function validateInput() {
  global $nickName, $headline, $questionText;

  if (($nickName == "") || ($headline == "") || ($questionText == "")) {
    echo "<strong>Some fields are required, plese fill remaining fields.</strong>";
  }
  else{
    // authenticating reCAPTCHA
    if(isset($_POST['g-recaptcha-response'])){
      $captcha=$_POST['g-recaptcha-response'];
    }
    if(!$captcha){
      echo '<strong>Prosím, zaškrtněte "reCAPTCHA" abychom věděli, že nejste robot.</strong>';
      exit;
    }
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKeyRecaptcha."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    if($response.success==false)
    {
      echo '<strong>Please stop...</strong>';
    } else {

      $my_post = array(
        'post_title'    => wp_strip_all_tags($_POST['headline']),
        'post_content'  => $_POST['question-text'],
        'post_type'     => 'post',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => array(1)
      );

      wp_insert_post($my_post);

    }
  }

}

?>
