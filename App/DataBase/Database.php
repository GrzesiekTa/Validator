<?php

namespace App\Database;

use PDO;

class Database {

    /**
     * @var string
     */
    protected $host = 'localhost';

    /**
     * @var string
     */
    protected $db = 'validator';

    /**
     * @var string
     */
    protected $username = 'root';

    /**
     * @var string
     */
    protected $password = '';

    /**
     * @var string
     */
    protected $stmt;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var PDO - object
     */
    public $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->pdo->query('SET CHARACTER SET utf8');
            $this->pdo->query('SET NAMES utf8');
        } catch (\Exception $e) {
            die("Blad polaczenia z baza danych ! skontaktuj sie z adminem");
        }
    }

    /**
     * @param string $table
     * 
     * @return $this
     */
    public function table(string $table): Database {
        $this->table = $table;

        return $this;
    }

    public function exists($data) {
        $field = array_keys($data)[0];

        return $this->where($field, '=', $data[$field])->count() ? true : false;
    }

    /**
     * 
     * @param string $field
     * @param string $operator
     * @param string $value
     * 
     * @return $this
     */
    public function where(string $field, string $operator, ?string $value): Database {
        $sql = "SELECT * FROM {$this->table} WHERE {$field} {$operator} ?";
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute([$value]);

        return $this;
    }

    /**
     * 
     * @return int
     */
    public function count() {
        return $this->stmt->rowCount();
    }

}

?>