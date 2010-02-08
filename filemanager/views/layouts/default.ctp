<?php echo $html->docType('html4-strict'); ?>
<html lang="en">
	<head>
		<?php echo $html->charset('utf-8') ?>
		<title>File Manager</title>
		<?php
			$base = '/filemanager/';
			echo $html->css($base . 'css/reset');
			echo $html->css($base . 'css/filemanager');
			echo $html->css($base . 'css/file_tree');
			echo $html->css($base . 'css/context_menu');
		?>
		<!--[if IE]>
		<?php echo $html->css($base . 'ie'); ?>
		<![endif]-->		
	</head>
	<body>

		<?php
		echo $form->create('Folder', array('id' => 'uploader'));
			echo $html->tag('h1', '');
			echo $html->tag('div', '', array('id' => 'uploadresponse'));
			?>
			<!--<input id="mode" name="mode" type="hidden" value="add" />
			<input id="currentpath" name="currentpath" type="hidden" />
			<input id="newfile" name="newfile" type="file" />
			<button id="upload" name="upload" type="submit" value="Upload">Upload</button>
			<button id="newfolder" name="newfolder" type="button" value="New Folder">New Folder</button>
			<button id="grid" class="ON" type="button" title="Switch to grid view.">&nbsp;</button><button id="list" type="button" title="Switch to list view.">&nbsp;</button>-->
		<?php echo $form->end(); ?>

		<div id="splitter">
			<div id="filetree"></div>
			<div id="filemanager">
				<div id="filelist"><h1>Folder is empty</h1></div>
				<div id="fileinfo"><h1>No file selected</h1></div>
			</div>
		</div>

		<ul id="itemOptions" class="contextMenu">
			<li class="select"><a href="#select">Select</a></li>
			<li class="download"><a href="#download">Download</a></li>
			<li class="rename"><a href="#rename">Rename</a></li>
			<li class="delete separator"><a href="#delete">Delete</a></li>
		</ul>

		<?php
			echo $html->script($base . 'js/jquery-1.4-min');
			echo $html->script($base . 'js/form/form');
			echo $html->script($base . 'js/splitter/splitter');
			echo $html->script($base . 'js/file_tree/file_tree');
			echo $html->script($base . 'js/context_menu/context_menu');
			echo $html->script($base . 'js/impromptu/impromptu');
			echo $html->script($base . 'js/table_sorter/table_sorter');
			echo $html->script($base . 'js/filemanager.config');
			echo $html->script($base . 'js/filemanager-rewrite');
		?>
	</body>
</html>
