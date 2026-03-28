<?php

abstract class BaseModel
{
    protected $pdo;

    public function __construct()
    {
        require __DIR__ . '/../../config/dataBase.php';
        $this->pdo = $pdo;
    }
}