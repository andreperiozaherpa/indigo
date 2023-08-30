<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Import Berita</title>
	</head>
	<body>
		<?php echo form_open_multipart(base_url('manage_post/import_berita')); ?>
			<h2>Import Berita</h2>
			<input type="file" name="berita" accept="text/csv">
			<br>
			<br>
			<button type="submit" name="import">Import Data</button>
		<?php echo form_close(); ?>
	</body>
</html>