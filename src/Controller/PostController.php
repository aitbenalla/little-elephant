<?php

namespace App\Controller;

class PostController extends Controller
{
    /**
     * @throws \SmartyException
     */
    public function list()
    {
        $this->display('admin/post/list.tpl');
    }

    /**
     * @throws \SmartyException
     */
    public function save($id)
    {
        $this->display('admin/post/form.tpl');
    }
}