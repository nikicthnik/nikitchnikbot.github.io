<?php 
header('Content-Type: application/json');
/*$id = '1';
$json = file_get_contents("./secretsmaximdada/base.json");
$obj = json_decode($json);
if(!isset($obj->{'p'}->{$id}->{'id'})){
	echo('привет');
};
echo ($obj->{'p'}->{$id}->{'id'}->{'dd'});*/

function getSignature($methods, array $paramss, $secretKey) {
	ksort($paramss);
	unset($paramss['sign']);
	unset($paramss['signature']);
	array_push($paramss, $secretKey);
	array_unshift($paramss, $methods);
	return hash('sha256', join('{up}', $paramss));
};
$params = $_GET['params'];
$method = $_GET['method'];
$secretKey = "2B0PUI7OYVYD56I31PZV";

if(!isset($_GET['method'])) {
	$result = array(
		'error' => array(
			'message' => 'invalid parametrs',
		),
	);
	echo(json_encode($result));
	return;
};


if($_GET['method'] == 'pay'){
	if(!isset($params['signature'])){
		$result = array(
			'error' => array(
				'message' => 'invalid parametrs',
			),
		);
		echo(json_encode($result));
		return;
	} else if($params['signature'] != getSignature($method, $params, $secretKey)) {
		$result = array(
			'error' => array(
				'message' => 'invalid signature',
			),
		);
		echo(json_encode($result));
		return;
	} else {
		$result = array(
			'result' => array(
				'message' => 'succesful',
			),
		);
		echo(json_encode($result));
		return;
	};
};

if($_GET['method'] == 'token.valid'){
	if(!isset($_GET['token'])){
		$result = array(
			'error' => 1,
		);
		echo(json_encode($result));
		return;
	} else {

		$json = file_get_contents("./secretsmaximdada/api.json");
		$obj = json_decode($json);

		if(!isset($obj->{$_GET['token']})) {
			$result = array(
				'error' => 1,
			);
			echo(json_encode($result));
			return;
		};

		$result = array(
			'error' => 0,
		);
		echo(json_encode($result));
		return;
	};
};

if($_GET['method'] == 'users.get'){
	if(!isset($_GET['token'])){
		$result = array(
			'error' => array(
				'message' => 'invalid token',
			),
		);
		echo(json_encode($result));
		return;
	};

	if(!isset($_GET['user_id'])){
		$result = array(
			'error' => array(
				'message' => 'invalid user_id',
			),
		);
		echo(json_encode($result));
		return;
	}

	$json = file_get_contents("./secretsmaximdada/base.json");
	$obj = json_decode($json);
	$jsons = file_get_contents("./secretsmaximdada/api.json");
	$objs = json_decode($jsons);

	if(!isset($objs->{$_GET['token']})){
		$result = array(
			'error' => array(
				'message' => 'invalid token',
			),
		);
		echo(json_encode($result));
		return;
	};

	if(!isset($obj->{'bs'}->{$_GET['user_id']})){
		$result = array(
			'error' => array(
				'message' => 'invalid user_id',
			),
		);
		echo(json_encode($result));
		return;
	};

	$result = array(
		'error' => 0,
		'response' => array(
			'id' => $obj->{'bs'}->{$_GET['user_id']}->{'id'},
			'nick' => $obj->{'bs'}->{$_GET['user_id']}->{'nick'},
		),
	);
	echo(json_encode($result));
	return;
};

$result = array(
		'error' => array(
			'message' => 'invalid parametrs',
		),
	);
echo(json_encode($result));
return;
?>