<?php


class Liste {
	private $id;
	private $nom;
	private $lesTaches;
	private $checked;
	private $idUtil;
	
	public function __construct(string $nom, ?int $id, int $checked=0, ?int $idUtil)
	{
		$this->id = $id;
		$this->nom=$nom;
		$this->checked = $checked;
		$this->lesTaches=[];
		$this->idUtil = $idUtil;
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
	public function setChecked(bool $checked)
	{
		$this->checked = $checked;
	}
	
	public function isChecked()
	{
		return $this->checked;
	}	

	public function getIdUtil()
	{
		return $this->idUtil;
	}
}
