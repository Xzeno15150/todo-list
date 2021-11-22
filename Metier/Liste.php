<?php

require 'Tache.php';

class Liste {
	private $id;
	private $nom;
	private $lesTaches;
	
	public function __construct(int $id, string $nom)
	{
		$this->id = $id;
		$this->nom=$nom;
		$this->lesTaches=[];
	}
	
	public function ajoutTache(Tache $tache)
	{
		$this->lesTaches[]=$tache;
	}

	public function setId(int $id)
	{
		$this->id=$id;
	}
	
	public function getId()
	{
		return $this->id;
	}	
	
	public function getNom()
	{
		return $this->nom;
	}
	
	public function setNom(string $nom)
	{
		$this->nom=$nom;
	}
	
	public function getTaches()
	{
		return $this->lesTaches;
	}	
}
