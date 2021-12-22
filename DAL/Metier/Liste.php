<?php

/**
 * Classe métier Liste
 */
class Liste {
	private $id;
	private $nom;
	private $lesTaches;
	private $checked;
	private $idUtil;

    /**
     * Constructeur d'une Liste
     * @param string $nom Nom de la liste
     * @param int|null $id ID de la liste, qui peut être créé à null
     * @param int $checked 1 si la Liste à été coché comme terminée, sinon 0
     * @param int|null $idUtil ID de l'utilisateur à qui appartient la liste, null si elle est publique
     */
	public function __construct(string $nom, ?int $id = null, int $checked=0, ?int $idUtil = null)
	{
		$this->id = $id;
		$this->nom=$nom;
		$this->checked = $checked;
		$this->lesTaches=[];
		$this->idUtil = $idUtil;
	}

    /**
     * Ajoute une Tâche à la liste des Tâches
     * @param Tache $tache Tâche à ajouter
     */
	public function ajoutTache(Tache $tache)
	{
		$this->lesTaches[]=$tache;
	}

    /**
     * Modifie l'ID de la Liste
     * @param int $id Nouveau ID
     */
	public function setId(int $id)
	{
		$this->id=$id;
	}

    /**
     * Retourne l'ID de la Liste
     * @return int|null
     */
	public function getId()
	{
		return $this->id;
	}

    /**
     * Retourne le nom de la Liste
     * @return string
     */
	public function getNom()
	{
		return $this->nom;
	}

    /**
     * Modifie le nom de la Liste
     * @param string $nom Nouveau nom de la Liste
     */
	public function setNom(string $nom)
	{
		$this->nom=$nom;
	}

    /**
     * Retourne la liste de Tâches
     * @return array
     */
	public function getTaches()
	{
		return $this->lesTaches;
	}

    /**
     * Modifie l'état de la Liste. (si la liste a été cochée comme terminée ou non)
     * @param bool $checked
     */
	public function setChecked(bool $checked)
	{
		$this->checked = $checked;
	}

    /**
     * Retourne l'état de la Liste (1 si cochée comme terminée, 0 sinon)
     * @return int
     */
	public function isChecked()
	{
		return $this->checked;
	}

    /**
     * Retourne l'ID de l'utilisateur propriétaire de la Liste (NULL pour la Liste est publique)
     * @return int|null
     */
	public function getIdUtil()
	{
		return $this->idUtil;
	}
}
