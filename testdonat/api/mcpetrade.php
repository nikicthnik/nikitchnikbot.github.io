<?php 

	

	file_get_contents('https://api.vk.com/method/messages.send?access_token=d8902d15f1fcda2a7d3b59f72dffb16b4c7bb4ce43b15d401a6a0d8f6fe6989294e0d31730dd2816aa46b&v=5.95&random_id='.mt_rand().'&group_id=181335822&message='.rawurlencode('выдать ' . $goods[$tovar] . ' ' . $id));

?>