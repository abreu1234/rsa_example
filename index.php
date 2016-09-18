<?php
include 'core/math.php';

$math = new Math();
$primos = $math->getPrimes(18);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rafael Abreu</title>
	<script src="js/jquery.js"></script>
	<script src="js/scripts.js"></script>
</head>
<body>
	<h1>Implementacão RSA</h1>
	<div>
		<label for="num_p">Escolha o P</label>
		<select id="num_p" name="num_p">
			<option value="">-- SELECIONE O P --</option>
		<?php foreach($primos as $primo) { ?>
			<option value="<?=$primo?>"><?=$primo?></option>
		<?php } ?>
		</select>

		<label for="num_q">Escolha o Q</label>
		<select id="num_q" name="num_q">
			<option value="">-- SELECIONE O Q --</option>
		<?php foreach($primos as $primo) { ?>
			<option value="<?=$primo?>"><?=$primo?></option>
		<?php } ?>
		</select>
		<br/>
		<br/>
		<label for="num_q">Escolha o E</label>
		<select id="num_e" name="num_q" disabled="">
			<option value="">-- SELECIONE O E --</option>
		</select>
		<br/>
		<br/>
		<label for="message">Digite a mensagem</label><br/>
		<textarea name="message" id="message" rows="5" cols="20"></textarea>
		<br/>
		<br/>
		<div id="conteudo" style="display:none">
			<b>Mensagem <span id="mensagem_action"></span>: </b> <span id="mensagem"></span><br/>
		</div>
		<br/>
		<br/>
		<button id="cifrar">Cifrar mensagem</button>
		<button id="decifrar">Decifrar mensagem</button>
	</div>
</body>
</html>