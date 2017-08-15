<?php /* Template Name: Import galerí */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/import-galleries.css">
<!-- modal template -->

<div id="content">
<div id="content-single-page" class="tpl-import-galleries">

<form>
	<div class="content-wrapper">
		<h1>Custom gallery importer</h1>
		<p>This importer works only with WordPress as the final destination for galleries.
		Additionaly, it expects table of gallery names [id, name] and another table of
		pictures [id, id-of-gallery, url]. Date for galleries is extracted from JPEG headers.</p>
	</div>

	<div class="highlighed-segment">
	<div class="content-wrapper">
		<table>
			<tr>
			<td>
		<h2>Exporting from:</h2>
		<label for="database-host-ex">Host name</label>
		<input type="text" name="database-host-ex" id="database-host-ex" placeholder="https://www.domena.cz">
		<label for="database-name-ex">Database name</label>
		<input type="text" name="database-name-ex" id="database-name-ex">
		<label for="database-user-ex">Database user name</label>
		<input type="text" name="database-user-ex" id="database-user-ex">
		<label for="database-pass-ex">Password</label>
		<input type="text" name="database-pass-ex" id="database-pass-ex">
			</td>
			<td>
		<h2>Importing to:</h2>
		<label for="database-name-im">Database name</label>
		<input type="text" name="database-name-im" id="database-name-im">
		<label for="database-user-im">Database user name</label>
		<input type="text" name="database-user-im" id="database-user-im">
		<label for="database-pass-im">Password</label>
		<input type="text" name="database-pass-im" id="database-pass-im">
			</td>
			</tr>
		</table>
		<table>
			<tr>
			<td>
		<h2>Import settings</h2>
		<label for="start-from-id">Import pictures starting from Index</label>
		<input type="number" name="start-from-id" id="start-from-id">
		<em>or start from begining</em></br>
		<button class="button-modern" id="submit-form">
			<div class="button-text">
			Import
			</div>
			<div class="button-background">
			<div class="btn-bg-sheet"></div>
			<div class="btn-bg-sheet"></div>
			</div>
		</button>
			</td>
			</tr>
		</table>
	</div>
	</div>
</form>
<div class="content-wrapper">
	<h2 class="log-headline">Log:</h2>
	<div id="dashboard-container">
		<div id="Msg-container"></div>
	</div>
</div>
</div>

<!-- import galleries handler -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/import-galleries.js"></script>

<?php

get_footer();

?>