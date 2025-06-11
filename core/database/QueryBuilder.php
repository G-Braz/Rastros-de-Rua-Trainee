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


public function selectAll($table, $inicio = 0, $itens_page = 10)
{
    $sql = "SELECT * FROM {$table} ORDER BY id DESC LIMIT {$inicio}, {$itens_page}";

    try {
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);

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

    public function insert($table, $parameters){

        $sql= sprintf( 'INSERT INTO %s (%s) VALUES(%s)',
            $table,
            implode(',', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
    );
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update ($table,$parameters, $id)
    {
        $sql=sprintf('UPDATE %s SET %s WHERE id = :id',
            $table,
            implode(', ', array_map(function($parameters){
                return $parameters . ' = :' . $parameters;
            },array_keys($parameters)))

        );

        $parameters['id'] = $id;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parameters);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function delete($table, $id){
        $sql = sprintf('DELETE FROM %s WHERE %s',
            $table,
            'id = :id'
        );
        
        try {
            if($table == 'usuarios'){
                $posts_delete = sprintf('DELETE FROM %s WHERE %s',
                    'publicacoes', 
                    'usuarios_id = :id'  
                );
                $stmt = $this->pdo->prepare($posts_delete);
                $stmt->execute(compact('id'));
            }
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(compact('id'));

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function findById($table, $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE id = ?");
        $statement->execute([$id]);
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function verificarLogin($email,$senha){
        $sql=sprintf('SELECT * FROM usuarios WHERE email=:email AND senha=:senha');

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'senha' => $senha
            ]);

            return $stmt->fetch(PDO::FETCH_OBJ);

        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

public function buscaPorTitulo($titulo){
    $sql = 'SELECT * FROM publicacoes WHERE titulo LIKE :titulo ORDER BY id DESC';

    try {

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(['titulo' => $titulo . '%']);

        return $stmt->fetchAll(\PDO::FETCH_OBJ);

    } catch (Exception $e) {
        
        die($e->getMessage());
    }
}

public function buscaPorTipo($tipo){
    $sql = 'SELECT * FROM publicacoes WHERE tipo = :tipo ORDER BY id DESC';

    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['tipo' => $tipo]);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

}