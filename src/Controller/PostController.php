<?php

namespace App\Controller;

class PostController extends Controller
{
    /**
     * @throws \SmartyException
     */
    public function list()
    {
        $this->display('post/list.tpl');
    }
}