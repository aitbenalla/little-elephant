<?php

namespace App\Controller;

class AppController extends Controller
{

    public function index()
    {
        if (isset($_POST['db_execute']) && !empty($_POST['db_execute'])) {
            if (is_object($this->getDB()->getServer())) {

                if ($_POST['db_execute'] === '1') {
                    $this->assign('flash', ['type' => 'success', 'message' => 'Connection succeeded']);
                }
                if ($_POST['db_execute'] === '2') {
                    $creating = $this->getDB()->createDatabase();

                    if ($creating === true) {
                        $this->assign('flash', ['type' => 'success', 'message' => 'Database created successfully']);
                    } else {
                        $this->assign('flash', ['type' => 'danger', 'message' => $creating]);
                    }
                }
                if ($_POST['db_execute'] === '3' && is_object($this->getDB()->getConnection())) {
                    $member = $this->getDB()->createTableMember();

                    if ($member === true) {
                        $this->assign('flash', ['type' => 'success', 'message' => 'Tables created successfully']);
                    } else {
                        $this->assign('flash', ['type' => 'danger', 'message' => $member]);
                    }
                } else if ($_POST['db_execute'] === '3' && !is_object($this->getDB()->getConnection())) {
                    $this->assign('flash', ['type' => 'danger', 'message' => $this->getDB()->getConnection()]);
                }
            } else {
                $this->assign('flash', ['type' => 'danger', 'message' => $this->getDB()->getServer()]);
            }
        }

        $this->display('home.tpl');
    }

    public function list()
    {
        $this->display('list.tpl');
    }

    public function add()
    {
        if (isset($_POST['add_row'])) {
            
        }
        $this->display('add.tpl');
    }

    public function error()
    {
        echo '404';
    }
}
