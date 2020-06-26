<?php 
	$id = $_POST['id'];
	$tovar = $_POST['tovar'];
	if(!isset($id) || !isset($tovar)) {
		header ('Location: https://erest.info/zakaz/');
		return;
	};
	$goods = [
		// aug
		79407 => [
			'name' => 'ᅠAUG 9MM',
			'command' => 'Выдать AUG 9MM %id',

		// обычный кейс
		],
		79408 => [
			'name' => 'ᅠОбычный кейс',
			'command' => 'Выдать обычный кейс %id',

		// особый кейс
		],
		79409 => [
			'name' => 'ᅠОсобый кейс',
			'command' => 'Выдать особый кейс %id',

		// редкий кейс
		],
		79410 => [
			'name' => 'ᅠРедкий кейс',
			'command' => 'Выдать редкий кейс %id',

		// искл кейс
		],
		79411 => [
			'name' => 'ᅠИсключительный кейс',
			'command' => 'Выдать исключительный кейс %id',

		// vip город
		],
		79412 => [
			'name' => 'ᅠVip город',
			'command' => 'Выдать vip %id',
		],
	];
	if(!isset($goods[$tovar])) {
		header ('Location: https://erest.info/zakaz/');
		return;
	};

	$site = file_get_contents('https://api.mcpetrade.com/shop.createPayment?shop=132089&server=16870&product='. $tovar .'&username='. $id .'&coupon=');

	$sites = json_decode($site);

	$sitess = $sites->{'response'};

	header ('Location:' . $sitess);
?>