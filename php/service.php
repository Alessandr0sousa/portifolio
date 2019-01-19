<?php  

function enviar()
{

	include "connect.php";

	date_default_timezone_set("Brazil/East");

	extract($_POST);
	
	$to 		= 'alessandro@ams2.life'; 
	$subject	= $assunto;
	$message	= $mensagem;
	$headers	= "mensagem enviada Por $nome, $telefone  e-mail: $email";
	$status 	= "Y";
	$data 		= date("Y-m-d H:i:s");
	$ano 		= date("Y");
	$rand		= mt_rand(1, 999999);

	mail($to, $subject, $message, $headers);

	$x = 0;
	while ($x == 0) {

		$ocorrencia = $ano.$rand;

		ocorrencia($ocorrencia);

		if ($res == 0) {		

			$sql_set = $pdo->prepare("INSERT into email_cliente_envio (id_ece, cliente_email_ece, assunto_email_ece, ocorrencia_ece, data_ece,status_ece) VALUES(null, :email, :assunto, :ocorrencia, :data, :status)");
			$sql_set->execute(array(

				'email'			=> 	$email, 
				'assunto'		=> 	$assunto, 
				'ocorrencia'	=> 	$ocorrencia, 
				'data'			=> 	$data, 
				'status'		=> 	$status

			));

			$chamado	= "Nº do chamado";
			$retorno	= "O numero da ocorrência referente a sua solicitação é: $ocorrencia!\n\n Atenciosamente\n\n Alessandro Sousa";
			$msg 		= "Mensagem automática não responder!";

			mail($email, $chamado, $retorno, $msg);

			$x++;
			echo json_encode("E-mail enviado com sucesso, você receberá o numero da sua ocorrência em seu email!");
		}
	}
}

function ocorrencia($ocorrencia)
{
	include "connect.php";
	$sql_get = $pdo->prepare("SELECT * from email_cliente_envio where ocorrencia_ece = :ocorrencia");
	// $sql_get = $pdo->prepare("SELECT count(*) from email_cliente_envio");
	$sql_get->execute(array('ocorrencia' => $ocorrencia));

	$res = $sql_get->fetchColumn();
	
}


extract($_POST);

switch ($tipo) {
	case 'enviar':
	enviar();
	break;
}

?>