<?php
require_once('Database.class.php');

// Connection Object
$conf = new Database();
$server = $conf->getServer();
$connection = $conf->getConnection();



