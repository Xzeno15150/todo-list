<?php 
/**
 * 
 */
class Utilisateur
{
	private $id;
	private $pseudo;

	public function __construct(int $id, string $pseudo)
	{
		$this->id = $id;
		$this->pseudo = $pseudo;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getPseudo()
	{
		return $this->pseudo;
	}

	public function setPseudo($pseudo)
	{
		$this->pseudo = $pseudo;
	}
}