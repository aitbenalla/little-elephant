<?php

namespace App\Controller\App;

use App\Controller\Controller;
use SmartyException;
class HomeController extends Controller
{
    /**
     * @throws SmartyException
     */
    public function index()
    {
        if (isset($_POST['db_execute']) && !empty($_POST['db_execute'])) {
            if (is_object($this->getDB()->getServer())) {

                if ($_POST['db_execute'] === '1') {
                    $this->flash('Server Connected', 'success','s_success');
                }
                if ($_POST['db_execute'] === '2') {
                    $creating = $this->getDB()->createDatabase();

                    if ($creating === true) {
                        $this->flash('Database created successfully', 'success','db_created');
                    } else {
                        $this->flash($creating, 'danger', 'db_error');
                    }
                }
                if ($_POST['db_execute'] === '3' && is_object($this->getDB()->getConnection())) {
                    $author = $this->getDB()->createTableAuthor();
                    $mediaAuthor = $this->getDB()->createTableMediaAuthor();
                    $post = $this->getDB()->createTablePost();
                    $mediaPost = $this->getDB()->createTableMediaPost();
                    $manager = $this->getDB()->createTableManager();
                    $category = $this->getDB()->createTableCategory();

                    if (
                        $author === true
                        && $mediaAuthor === true
                        && $post === true
                        && $mediaPost === true
                        && $manager === true
                        && $category === true
                    ) {
                        $this->flash('Tables created successfully', 'success','tables_created');
                    } else {
                        $this->flash('Tables cannot be created or all ready created', 'danger', 'tables_error');
                    }
                } else if ($_POST['db_execute'] === '3' && !is_object($this->getDB()->getConnection())) {
                    $this->flash($this->getDB()->getConnection(), 'danger', 'c_error');
                }
            } else {
                $this->flash($this->getDB()->getServer(), 'danger', 's_error');
            }
        }

        $this->display('app/home.tpl');
    }
}
