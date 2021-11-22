<?php

class Liste {
	private $nom;
	private $lesTaches;
	
	public function __construct(string $nom)
	{
		$this->nom=$nom;
		$lesTaches=[];
	}
	
	public function ajoutTache(Tache $tache)
	{
		$lesTaches[]=$tache;
	}
	
	public function getNom()
	{
		return $nom;
	}
	
	public function setNom(string $nom)
	{
		$this->nom=$nom;
	}
	
	public function getTaches()
	{
		return $lesTaches;
	}	
}

?>
