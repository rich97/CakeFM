<?php echo $html->docType('html4-strict'); ?>
<html lang="en">
	<head>
		<?php echo $html->charset('utf-8') ?>
		<title>File Manager</title>
		<?php
			$base = '/filemanager/';
			echo $html->css($base . 'css/filemanager');
			echo $html->css($base . 'css/file_tree');
			echo $html->css($base . 'css/context_menu');
			echo $html->css($base . 'css/colourbox/colorbox');
		?>
		<!--[if lte IE7]>
		<?php echo $html->css($base . 'ie'); ?>
		<![endif]-->		
	</head>
	<body>

		<div id="tools">
			<ul class="clearfix">
				<li><?php echo $html->link('New Folder', '#', array('class' => 'fmNewFolder')); ?></li>
				<li><?php echo $html->link('Upload', '#', array('class' => 'fmUpload')); ?></li>
				<li><?php echo $html->link('Download', '#', array('class' => 'fmDownload')); ?></li>
			</ul>
		</div>

		<div id="manager" class="clearfix">
			<div id="filetree">
				<div class="pad">
					<strong>No Files</strong>
				</div>
			</div>
			<div id="filelist">
				<div class="pad border">
					<strong>Folder is empty</strong>
				</div>
			</div>
			<div id="fileinfo">
				<div class="pad">
					<strong>No file selected</strong>
				</div>
			</div>
		</div>

		<?php
			echo $html->script($base . 'js/jquery-1.4-min');
			echo $html->script($base . 'js/jquery-ui-1.7.2-min');
			echo $html->script($base . 'js/form.js');
			echo $html->script($base . 'js/file_tree/file_tree');
			echo $html->script($base . 'js/colourbox-min');
			echo $html->script($base . 'js/filemanager-rewrite');
		?>

	</body>
</html>
