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

        // Create Tables
        if ($_POST['db_execute'] === '3' && is_object($connection)) {
            $member = $conf->createTableMember();
            $image = $conf->createTableImage();

            if ($member === true && $image === true) {
                getAlert('success', '', 'Tables created successfully');
            } else {
                getAlert('warning', '', $member . $image);
            }
        } else if ($_POST['db_execute'] === '3' && !is_object($connection)) {
            getAlert('error', '', $connection);
        }
    } else {

        getAlert('error', '', $server);
    }
}
