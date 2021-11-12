<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require 'connect.php';

if (isset($_POST['db_execute']) && !empty($_POST['db_execute'])) {
    if (is_object($server)) {
        // Connection Testing
        if ($_POST['db_execute'] === '1') {
            getAlert('success', '', 'Connection succeeded');
        }

        // Create Database
        if ($_POST['db_execute'] === '2') {
            $creating = $conf->createDatabase();

            if ($creating === true) {
                getAlert('success', '', 'Database created successfully');
            } else {
                getAlert('warning', '', $creating);
            }
        }

        // Create Table Members
        if ($_POST['db_execute'] === '3' && is_object($connection)) {
            $creating = $conf->createTableMembers();

            if ($creating === true) {
                getAlert('success', '', 'Table created successfully');
            } else {
                getAlert('warning', '', $creating);
            }
        } else if ($_POST['db_execute'] === '3' && !is_object($connection)) {
            getAlert('error', '', $connection);
        }
    } else {

        getAlert('error', '', $server);
    }
}
