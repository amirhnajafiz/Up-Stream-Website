<?php

namespace mvc\model;

use mvc\model\Model;
use mvc\model\traits\Total;

/**
 * Request model is the request schema in our database.
 * 
 */
class Request extends Model 
{
    // traits
    use Total;

    public int $id;

    protected $table_name = "request";

    public function getRequestMovies()
    {
        $sth = $this->pdo->prepare("SELECT F.name, F.uploader, F.size, F.type, F.uploaddate, R.id
                                    FROM $this->table_name as R JOIN file as F ON F.id = R.id");
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_OBJ);
    }

    public function insertRequest($id) 
    {
        return $this->insert($this->table_name, ['id' => $id]);
    }

    public function removeRequest($id)
    {
        return $this->delete($this->table_name, ['id' => $id]);
    }
}

?>