<?php

namespace App\Controller\App;

use App\Controller\Controller;
use App\Model\CategoryRepository;
use App\Model\MediaPostRepository;
use App\Model\PostRepository;
use JetBrains\PhpStorm\NoReturn;
use SmartyException;

class PostController extends Controller
{
    /**
     * @throws SmartyException
     */
    public function show()
    {
        $repository = new PostRepository();
        $this->display('app/post/show.tpl', ['posts'=>$repository->getAll()]);
    }
    /**
     * @throws SmartyException
     */
    #[NoReturn]
    public function save()
    {
        $categories = new CategoryRepository();
        $repository = new PostRepository();

        if (isset($_SESSION['author']))
        {
            if (isset($_POST['postIt']))
            {
                $persist = $repository->persist($_POST);

                $result = $repository->flush($persist);

                if ($result && !empty($_FILES["postCover"]["name"])) {

                    $mediaRepository = new MediaPostRepository();

                    $persist_media = $mediaRepository->persist($_FILES, $result);
                    $mediaRepository->flush($persist_media);
                }

                if ($result) {

                    $this->flash('Saved. <a href="/posts">Go To Posts</a>', 'success', 'post_created');
                }
            }

            $this->display('app/post/save.tpl', ['categories' => $categories->getAll()]);
        }
        else
        {
            header("Refresh:0; url=/login");
            exit;
        }

    }
}