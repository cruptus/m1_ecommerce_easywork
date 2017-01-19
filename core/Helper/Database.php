<?php
namespace App\Helper;
use \PDO;
/**
 * Class Database
 */
class Database{

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @param string $login
     * @param string $password
     * @param string $database_name
     * @param string $host
     */
    public function __construct($login, $password, $database_name, $host = 'localhost'){
        $this->pdo = new PDO("mysql:dbname=$database_name;host=$host", $login, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }


    /**
     * @param $statement
     * @param $class_name
     * @return array
     */
    public function query($statement, $class_name){
        $req = $this->pdo->query($statement);
        return $req->fetchAll(PDO::FETCH_CLASS, $class_name);
    }


    /**
     * @param $statement
     * @param $attributes
     * @return array|mixed
     */
    public function prepare($statement, $attributes){
        $req = $this->pdo->prepare($statement);
        return ($req->execute($attributes)) ? $req : false;
    }

    /**
     * Protege des injections SQL
     * @param array $params
     * @return array
     */
    private function protect($params){
        $params_temp = array();
        for($i = 0; $i < count($params); $i++){
            if(ctype_digit($params[key($params)]))
                $temp = intval($params[key($params)]);
            else
            {
                $temp = $this->pdo->quote($params[key($params)]);
                $temp = addcslashes($temp, '%_');
            }
            $params_temp[key($params)] = $temp;
            next($params);
        }
        return $params_temp;
    }


    /**
     * Retourne le dernier id inséré
     * @return int
     */
    public function lastInsertId(){
        return $this->pdo->lastInsertId();
    }


    public function insert($table, $fields){
        $query = "INSERT INTO $table (";
        $items = "VALUES (";
        $values = array();

        foreach ($fields as $key => $value){
            $values[':'.$key] = $value;
            $query .= $key;
            $items .= ':'.$key;
            if(end($fields) != $value) {
                $query .= ', ';
                $items .= ', ';
            } else {
                $query .= ')';
                $items .= ')';
            }
        }
        return $this->pdo->prepare($query.$items)->execute($values);
    }
}