
<?php
	$dir = CONTENT_DIRECTORY;

	if (isset($_REQUEST['file'])) {
		$file = $_REQUEST['file'];
		$pi = pathinfo($dir . $file);
		switch (strtolower($pi['extension'])) {
			case "jpg" || "jpeg":
				header('Content-Type: image/jpeg');
				break;
			default:
				echo "unsupported file type";
				exit;
		}
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename="' . $file . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($dir . $file));
		ob_clean();
		flush();
		readfile($dir . $file);
	} else {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if ($file == "." || $file == ".." || $file == ".htaccess")
					continue;
				echo "<a target=\"_blank\" href=\".?content&file=" . $file . "\">" . $file . "</a><br />";
			}
			closedir($dh);
		}
	}
?>
