<?php
	// на какие данные рассчитан этот скрипт
	header("Content-Type: application/json");
	var_dump($_REQUEST);
	$data = file_get_contents('php://input');
	var_dump($data);
	die();
	$data = json_decode($data, true);
	$ch   = curl_init('https://directalab.ru/b24/forms/ajax.php');
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$res = curl_exec($ch);
	if ($errno = curl_errno($ch)) {
		$message = curl_strerror($errno);
		echo 'Ошибка отправки в wp-content\themes\skinelly\ajax\bitrix_send.php';
	}
	curl_close($ch);

	$res = json_encode($res, JSON_UNESCAPED_UNICODE);

