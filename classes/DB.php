<?php


namespace classes;
use \PDO;

class DB
{

    private   $instance = null;
    private   $db = 'dbname';
    private   $user = 'username';
    private   $pass = 'password';
    private   $host = 'host';
    private   $charset = 'utf8';
    private   $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    public function __construct()
    {
        $this->getInstance();
    }

    private  function getInstance()
    {
        return $this->instance instanceof PDO ? $this->instance : $this->instance = new PDO(
            "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset,
            $this->user,
            $this->pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }
    public  function execute(string $sql, array $params = [])
    {
        $this->instance;
        $stmt = $this->instance->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }



    public  function getRow(string $sql, array $params = [])
    {
        return $this->execute($sql, $params)->fetch();
    }


}