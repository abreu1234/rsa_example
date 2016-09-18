<?php
//TODO validations

include 'core/rsa.php';
$rsa = new RSA();
$action = $_POST["action"];

switch ($action) {
	case 'get_e':
		$rsa->setP($_POST["num_p"]);
		$rsa->setQ($_POST["num_q"]);
		echo json_encode($rsa->getPossibleE());
	break;
	case 'cifrar':
		$rsa->setP($_POST["num_p"]);
		$rsa->setQ($_POST["num_q"]);
		$rsa->setE($_POST["num_e"]);
		echo $rsa->encrypt($_POST["mensagem"]);
	break;	case 'decifrar':
		$rsa->setP($_POST["num_p"]);
		$rsa->setQ($_POST["num_q"]);
		$rsa->setE($_POST["num_e"]);
		echo $rsa->decrypt($_POST["mensagem"]);
	break;
}