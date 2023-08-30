<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Import Data Pelanggan</title>
	</head>
	<body>
		<?php echo form_open_multipart(base_url('manage_post/import')); ?>
			<h2>Import Data Pelanggan</h2>
			<input type="file" name="video" accept="text/csv">
			<br>
			<br>
			<button type="submit" name="import">Import Data</button>
		<?php echo form_close(); ?>
	</body>
</html>