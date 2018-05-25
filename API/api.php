<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 24/05/2018
 * Time: 09:45
 */

class API
{
    private $connect = '';

    function __construct()
    {

        $this->database_connection();
    }

    function database_connection()
    {

        $this->connect = new PDO("mysql:host=ec2-54-83-204-6.compute-1.amazonaws.com
;dbname=dfumn4ge9ot7ce", "elqlhedwlzqxql", "f8a980fdde404dba4c55c3a687d6c9039e7d63baf1bf9cb33782e25f795e38b8");
    }


    public function fetch_all()
    {

        $query = "SELECT * FROM sample ORDER BY id";
        $statement = $this->connect->prepare($query);

        if ($statement->execute()) {

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

                $data[] = $row;
            }
            return $data;
        }


    }


    public function insert()
    {
        if (isset($_POST["filme"])) {
            $form_data = array(
                ':filme' => $_POST["filme"],
                ':diretor' => $_POST["diretor"],
                ':genero' => $_POST["genero"],
                ':avaliacao' => $_POST["avaliacao"],
                ':sinopse' => $_POST["sinopse"]

            );
            $query = "
   INSERT INTO sample 
   (filme, diretor, genero, avaliacao, sinopse) VALUES 
   (:filme, :diretor, :genero, :avaliacao, :sinopse)
   ";
            $statement = $this->connect->prepare($query);
            if ($statement->execute($form_data)) {
                $data[] = array(
                    'success' => '1'
                );
            } else {
                $data[] = array(
                    'success' => '0'
                );
            }
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }


    public function fetch_single($id)
    {


        $query = "SELECT * FROM sample WHERE id= '" . $id . "'";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {

            foreach ($statement->fetchAll() as $row) {

                $data['filme'] = $row['filme'];
                $data['diretor'] = $row['diretor'];
                $data['genero'] = $row['genero'];
                $data['avaliacao'] = $row['avaliacao'];
                $data['sinopse'] = $row['sinopse'];
            }
            return $data;
        }

    }


    public function update()
    {


        if (isset($_POST["filme"])) {
            $form_data = array(
                ':filme' => $_POST["filme"],
                ':diretor' => $_POST["diretor"],
                ':genero' => $_POST["genero"],
                ':avaliacao' => $_POST["avaliacao"],
                ':sinopse' => $_POST["sinopse"],
                ':id' => $_POST['id']
            );
            $query = "


   UPDATE sample 
   SET filme = :filme, diretor = :diretor, genero = :genero , avaliacao = :avaliacao , sinopse = :sinopse  
   WHERE id = :id
   ";
            $statement = $this->connect->prepare($query);
            if ($statement->execute($form_data)) {
                $data[] = array(
                    'success' => '1'
                );
            } else {
                $data[] = array(
                    'success' => '0'
                );
            }
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }


    public function delete($id)
    {
        $query = "DELETE FROM sample WHERE id = '" . $id . "'";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }



}



