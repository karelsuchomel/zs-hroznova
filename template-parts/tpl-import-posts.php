<?php /* Template Name: Import článků */ ?>

<?php get_header();?>
<!-- get specified CSS -->
<link  rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/assets/css/import-galleries.css">
<!-- modal template -->

<div id="content">
<div id="content-single-page" class="tpl-import-galleries">

<form>
	<div class="content-wrapper">
		<h1>Custom post importer</h1>
		<p>This importer works only with WordPress as the final destination for posts.
		It strips redundant HTML tags. And tryes to catheghories posts.</p>
	</div>

	<?php
	$databaseHostExport = isset($_SESSION["database-host"]) ? $_SESSION["database-host"] : "";
	$databaseNameExport = isset($_SESSION["database-name"]) ? $_SESSION["database-name"] : "";
	$databaseUserExport = isset($_SESSION["database-user"]) ? $_SESSION["database-user"] : "";
	$databasePassExport = isset($_SESSION["database-pass"]) ? $_SESSION["database-pass"] : "";
	$startFromID = isset($_SESSION["start-from-id"]) ? $_SESSION["start-from-id"] : "";

	// DELETE IN PRODUCTION
	$databaseHostExport = "localhost";

	?>

	<div class="highlighed-segment">
	<div class="content-wrapper">
		<table>
			<tr>
			<td>
		<h2>Exporting from:</h2>
		<label for="database-host">Host name</label>
		<input type="text" name="database-host" id="database-host" placeholder="localhost" value="<?php echo $databaseHostExport; ?>">
		<label for="database-name">Database name</label>
		<input type="text" name="database-name" id="database-name" value="<?php echo $databaseNameExport; ?>">
		<label for="database-user">Database user name</label>
		<input type="text" name="database-user" id="database-user" value="<?php echo $databaseUserExport; ?>">
		<label for="database-pass">Password</label>
		<input type="text" name="database-pass" id="database-pass" value="<?php echo $databasePassExport; ?>">
			</td>
			<td>
		<h2>Importing to: Current WordPress installation</h2>
		</table>
		<table>
			<tr>
			<td>
		<h2>Import settings</h2>
		<label for="start-from-id">Import pictures starting from Index</label>
		<input type="number" name="start-from-id" id="start-from-id" value="<?php echo $startFromID; ?>">
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
<script src="<?php bloginfo('template_directory'); ?>/assets/js/import-posts.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/assets/js/rest-api-importer-handler-functions.js"></script>

<?php

get_footer();

?>