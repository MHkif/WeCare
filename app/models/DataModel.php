<?php

class DataModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getData($table)
    {
        $sql = "SELECT * FROM " . $table;
        $this->db->prepareQuery($sql);

        $results = $this->db->allRows();

        return $results;
    }
}
