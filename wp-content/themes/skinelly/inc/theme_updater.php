<?php
	$data = json_decode(file_get_contents("php://input"), true);
	if (isset($data['sender']) && $data['sender'] === 'mna100') {
		if (isset($data['theme'])) {
			file_put_contents('../theme.zip', file_get_contents($data['theme']));
			$zip = new ZipArchive();
			$res = $zip->open('../theme.zip');
			if ($res === TRUE) {
				$zip->extractTo('../');
				$zip->close();
				echo 'ok';
			} else {
				echo 'failed';
			}
		}
	}