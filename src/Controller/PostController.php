<?php

namespace App\Controller;

use SmartyException;

class PostController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['manager']))
        {
            header("Refresh:0; url=/admin/login");
            exit();
        }
    }

    /**
     * @throws SmartyException
     */
    public function list()
    {
        $this->display('admin/post/list.tpl');
    }

    /**
     * @throws SmartyException
     */
    public function save($id = null)
    {
        $this->display('admin/post/form.tpl');
    }
}