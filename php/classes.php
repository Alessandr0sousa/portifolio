<?php  

class Mensagem
{
	extract($_POST);
	
	protected $nome 		= nome;
	protected $email 		= email;
	protected $telefone		= telefone;
	protected $assunto 		= assunto;
	protected $mensagem		= mensagem;

	public function getNome()
	{
		return $this->nome
	}


}

?>