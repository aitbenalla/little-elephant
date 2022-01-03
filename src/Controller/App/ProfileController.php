<?php

namespace App\Controller\App;

use App\Controller\Controller;
use App\Model\PostRepository;
use JetBrains\PhpStorm\NoReturn;
use SmartyException;

class ProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['author']))
        {
            header("Refresh:0; url=/login");
            exit();
        }
    }

    /**
     * @throws SmartyException
     */
    #[NoReturn]
    public function dashboard()
    {
        if (isset($_SESSION['author']))
        {
            $posts = new PostRepository();
            $this->display('app/profile/dashboard.tpl', ['posts'=>$posts->getByAuthor($_SESSION['author']->getId())]);
        }
        else
        {
            header("Refresh:0; url=/login");
            exit;
        }
    }
}