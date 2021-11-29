<?php 
/**
 * 
 */
class Utilisateur
{
	private $id;
	private $pseudo;
	private $mdp;

	public function __construct(int $id, string $pseudo, string $mdp)
	{
		$this->id = $id;
		$this->pseudo = $pseudo;
		$this->mdp = $mdp;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getPseudo()
	{
		return $this->pseudo;
	}

	public function getMdp()
	{
		return $this->mdp;
	}

	public function setPseudo($pseudo)
	{
		$this->pseudo = $pseudo;
	}
}