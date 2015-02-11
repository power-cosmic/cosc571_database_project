<!doctype html>
<html>
	<head>
		<title>List of pages</title>
	</head>
	<body>
		<?php
			$dir = getcwd();
			if (is_dir($dir)){
				if ($dh = opendir($dir)){
					while (($file = readdir($dh)) !== false){
					  if (substr($file, 0, 1) != '.') {
						  echo "<a href='$file'>$file</a><br />\n";
					  }
					}
				closedir($dh);
				}
			}
		?>
	</body>
</html>