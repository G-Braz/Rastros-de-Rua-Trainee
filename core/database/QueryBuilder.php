<?php

namespace App\Core\Database;

use PDO, Exception;

class QueryBuilder
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectOne($table, $parameters, $id=null){
        $sql = sprintf(
            'SELECT * FROM %s WHERE %s = :%s',
            $table,
            implode(', ', array_keys($parameters)),
            implode(', :', array_keys($parameters)),
        );
        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
            $dados = $stmt->fetch(PDO::FETCH_OBJ);
            if ($dados) {
                if ($id !== null) {
                    if ($id == $dados->id) {
                        return null;
                    }
                    return $dados;
                }
                return $dados;
            }
            return null;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function selectAll($table, $inicio=null, $num_linhas=null)
    {
        $sql = "select * from {$table}";
        if($inicio>=0 && $num_linhas > 0){
            $sql .= " LIMIT {$inicio}, {$num_linhas}";
        }
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function countAll($table)
    {
        $sql = "select COUNT(*) from {$table}";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return intval($stmt->fetch(PDO::FETCH_NUM)[0]);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)', 
        
        $table,
        implode(', ', array_keys($parameters)),
        implode(', ', array_map(function($key) {
            return ':' . $key;
        }, array_keys($parameters)))
    );
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    
    }

    public function update($table, $id, $parameters)
    {
        $sql = sprintf('UPDATE %s SET %s WHERE id = %s',
            $table, 
            implode(', ', array_map(function($param){
                return $param . " = :" . $param;
            }, array_keys($parameters))),
            $id
        ); 

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    
    }

    public function delete($table, $id)
    {
        $sql = sprintf('DELETE FROM %s WHERE %s',
            $table, 
            'id = :id'
        ); 

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(compact('id'));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}