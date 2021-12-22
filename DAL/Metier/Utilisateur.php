<?php 
/**
 * Classe métier Utilisateur
 */
class Utilisateur
{
	private $id;
	private $pseudo;

    /**
     * Constructeur d'un Utilisateur
     * @param int $id ID de l'Utilisateur
     * @param string $pseudo Pseudo de l'Utilisateur
     */
	public function __construct(int $id, string $pseudo)
	{
		$this->id = $id;
		$this->pseudo = $pseudo;
	}

    /**
     * Retourne l'ID de l'Utilisateur
     * @return int
     */
	public function getId()
	{
		return $this->id;
	}

    /**
     * Retourne le pseudo de l'Utilisateur
     * @return string
     */
	public function getPseudo()
	{
		return $this->pseudo;
	}

    /**
     * Modifie le pseudo de l'Utilisateur
     * @param string $pseudo Nouveau
     */
	public function setPseudo(string $pseudo)
	{
		$this->pseudo = $pseudo;
	}
}