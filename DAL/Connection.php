<?php

/**
 * Classe qui permet la connection à la base de données
 */
class Connection extends PDO {

    private $stmt;

    /**
     * @param string $dsn URL d'accés à la base
     * @param string $username Pseudo de connection à la base
     * @param string $password Mot de passe de connection à la base
     */
    public function __construct(string $dsn, string $username, string $password) {

        parent::__construct($dsn,$username,$password);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    /**
     * Execute en base la requête SQL passée en paramètre
     * @param string $query Requête à exécuter en base
     * @param array $parameters Tableaux des étiquettes utilisées dans la requête
     * @return bool Returns `true` on success, `false` otherwise
     */
    public function executeQuery(string $query, array $parameters = []) : bool{
        $this->stmt = parent::prepare($query);
        foreach ($parameters as $name => $value) {
            $this->stmt->bindValue($name, $value[0], $value[1]);
        }

        return $this->stmt->execute();
    }

    /**
     * Retourne le résultat d'une requête (select)
     * @return array
     */
    public function getResults() : array {
        return $this->stmt->fetchall();

    }
}

?>
