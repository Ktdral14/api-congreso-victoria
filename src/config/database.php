<?php

class Database
{

    // Localhost (kt)
    // private $host    = 'localhost';
    // private $user    = 'root';
    // private $pass    = '';
    // private $db      = 'mantehostingacm_cotacyt';

    // ACM
    private $host   = 'mante.hosting.acm.org';
    private $user   = 'mantehostingacm_chino';
    private $pass   = 'tecmante159357';
    private $db     = 'mantehostingacm_congreso_victoria';

    public function connectDB()
    {
        $mysqlConnect = "mysql:host=$this->host;dbname=$this->db;charset=utf8mb4;";
        $dbConnection = new PDO($mysqlConnect, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}
