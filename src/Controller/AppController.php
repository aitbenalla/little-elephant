<?php

namespace App\Controller;

use SmartyException;
class AppController extends Controller
{
    /**
     * @throws SmartyException
     */
    public function index()
    {
        if (isset($_POST['db_execute']) && !empty($_POST['db_execute'])) {
            if (is_object($this->getDB()->getServer())) {

                if ($_POST['db_execute'] === '1') {
                    $this->flash('Connection succeeded', 'success');
                }
                if ($_POST['db_execute'] === '2') {
                    $creating = $this->getDB()->createDatabase();

                    if ($creating === true) {
                        $this->flash('Database created successfully', 'success');
                    } else {
                        $this->flash($creating, 'danger');
                    }
                }
                if ($_POST['db_execute'] === '3' && is_object($this->getDB()->getConnection())) {
                    $author = $this->getDB()->createTableAuthor();
                    $mediaAuthor = $this->getDB()->createTableMediaAuthor();
                    $post = $this->getDB()->createTablePost();
                    $mediaPost = $this->getDB()->createTableMediaPost();
                    $admin = $this->getDB()->createTableAdmin();

                    if ($author === true
                        && $mediaAuthor === true
                        && $post === true
                        && $mediaPost === true
                        && $admin === true
                    ) {
                        $this->flash('Tables created successfully', 'success');
                    } else {
                        $this->flash('Tables cannot be created or all ready created', 'danger');
                    }
                } else if ($_POST['db_execute'] === '3' && !is_object($this->getDB()->getConnection())) {
                    $this->flash($this->getDB()->getConnection(), 'danger');
                }
            } else {
                $this->flash($this->getDB()->getServer(), 'danger');
            }
        }

        $this->display('home.tpl');
    }

    public function error()
    {
        echo '404';
    }
}
