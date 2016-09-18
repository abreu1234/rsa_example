$(document).ready(function(){
	$("select").change(function(){
		var num_p = $("#num_p").val();
		var num_q = $("#num_q").val();

		if(num_p != "" && num_q != "") {
			$.post( "requests.php", { action: "get_e",num_p:num_p,num_q:num_q})
			.done(function( data ) {
				var json = JSON.parse(data);
				$.each(json, function (index, value) {
					$('#num_e').append($('<option>', {
						value: value,
						text: value
					}));
					$('#num_e').prop("disabled", false);
				});
			});
		}
	});

	$("#cifrar").click(function(){
		var num_p = $("#num_p").val();
		var num_q = $("#num_q").val();
		var num_e = $("#num_e").val();
		var mensagem = $("#message").val();

		$.post( "requests.php", { action: "cifrar",num_p:num_p,num_q:num_q,num_e:num_e,mensagem:mensagem })
		.done(function( data ) {
			$("#mensagem_action").text("cifrada");
			$("#mensagem").text(data);
			$("#conteudo").show();
		});
	});	

	$("#decifrar").click(function(){
		var num_p = $("#num_p").val();
		var num_q = $("#num_q").val();
		var num_e = $("#num_e").val();
		var mensagem = $("#message").val();

		$.post( "requests.php", { action: "decifrar",num_p:num_p,num_q:num_q,num_e:num_e,mensagem:mensagem })
		.done(function( data ) {
			$("#mensagem_action").text("decifrada");
			$("#mensagem").text(data);
			$("#conteudo").show();
		});
	});

});