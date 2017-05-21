<?php/* Template Name: Import galerí */?>
<html>
<head>
	<title>Custom gallery importer</title>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="description" content="Základní škola Brno, Hroznová 1">
	<meta name="keywords" content="Základní škola Brno, Hroznová 1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Links-->
	<!-- Fonts-->
	<!-- Open Sans Light 300, Light Italic, Normal 400, Semi-bold 600, Bold 700-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600,700&amp;subset=latin-ext" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body>

	<div id="#content-wrap">
		<form style="max-width: 640px; margin: 0 auto;">
			<h1>Custom gallery importet</h1>
			<p>This importer works only with WordPress as the final destination for galleries.
			Additionaly, it expects table of gallery names [id, name] and another table of
			pictures [id, id-of-gallery, url]. Date for galleries is extracted from JPEG headers.</p>
			<label for="start-from-picture-id">Import pictures starting with picture ID</label><br>
			<input type="number" name="start-from-picture-id" id="start-from-picture-id">
			<em>or start from begining</em><br><br>
			<button type="submit" id="submit-form" style="border: 1px solid #777; border-radius: 5px; padding: 10px 15px; background: white;">Begin with import</button>
		</form>
		<div id="dashboard-container" style="max-width: 640px; margin: 0 auto;">

		<script>
		// get starting ID
		var startImageID = 1;
		startImageID = document.getElementById("start-from-picture-id").value;
		var phpAjaxFuntionLocation = "http://localhost/zs-hroznova/";
		phpAjaxFuntionLocation += "wp-content/themes/zs-hroznova/template-parts/import-galleries-ajax-functions.php";

		function importHandler (e)
		{
			e.preventDefault();

			// get info about database
			var initialRequest = new XMLHttpRequest();
			initialRequest.open('GET', phpAjaxFuntionLocation + "?initial=TRUE");
			initialRequest.onload = function () {
				var JSONData = initialRequest.responseText;
				console.log( JSONData );
			};
			initialRequest.send();
		};

		// add event listeners
		document.getElementById("submit-form").addEventListener( 'click', importHandler );




		</script>
		</div>
	</div>

</body>
</html>
<?php //require_once('import-galleries-ajax-functions.php'); ?>