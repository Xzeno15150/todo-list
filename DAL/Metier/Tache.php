<?php 

/**
 * Classe métier Tache
 */
class Tache
{
	private $id;
	private $title;
	private $desc;
	private $checked;

    /**
     * Constructeur d'une Tâche
     * @param string $title Titre de la Tâche
     * @param string $desc Description de la Tâche
     * @param int|null $id ID de la Tâche (peut être créée avec un id NULL qui sera incrémenté dans la base)
     * @param int $checked 1 si la Tâche à été coché comme terminée, sinon 0
     */
	public function __construct(string $title, string $desc, ?int $id=NULL, $checked=0)
	{
		$this->id = $id;
		$this->title = $title;
		$this->desc = $desc;
		$this->checked = $checked;
	}

    /**
     * Retourne l'ID de la Tâche
     * @return int|null
     */
	public function getId()
	{
		return $this->id;
	}

    /**
     * Retourne le titre de la Tâche
     * @return string
     */
	public function getTitle()
	{
		return $this->title;
	}

    /**
     * Retourne la description de la Tâche
     * @return string
     */
	public function getDesc()
	{
		return $this->desc;
	}

    /**
     * Retourne l'état de la Tâche (1 si cochée comme terminée, 0 sinon)
     * @return int
     */
	public function getChecked()
	{
		return $this->checked;
	}

    /**
     * Modifie l'ID de la Tâche
     * @param int $id Nouveau ID de la Tâche
     */
	public function setId(int $id)
	{
		$this->id = $id;
	}

    /**
     * Modifie le titre de la Tâche
     * @param string $title
     */
	public function setTitle(string $title)
	{
		$this->title = $title;
	}

    /**
     * Modifie la description de la Tâche
     * @param string $desc
     */
	public function setDesc(string $desc)
	{
		$this->desc = $desc;
	}

    /**
     * Modifie l'état de la Tâche (1 si cochée comme terminée, 0 sinon)
     * @param bool $checked
     */
	public function setChecked(bool $checked)
	{
		$this->checked = $checked;
	}
}