<?php

namespace App\Controller\App;

use App\Controller\Controller;
use App\Controller\flash;
use App\Form\MediaPostType;
use App\Form\PostType;
use App\Model\MediaPostRepository;
use App\Model\PostRepository;
use JetBrains\PhpStorm\NoReturn;
use SmartyException;

class PostController extends Controller
{
    use flash;
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
     * @throws \DOMException
     */
    #[NoReturn]
    public function save($id = null)
    {
        $repository = new PostRepository();
        $form = new PostType();
        $postForm = $form->buildForm();

        if (isset($_SESSION['author']))
        {
            if ($id)
            {
                $post = $repository->getById($id);
                $postForm = $form->buildForm($post);
            }

            if (isset($_POST['postIt']))
            {
                $persist = $form->submit($_POST);

                $result = $repository->flush($persist);

                if ($result && !empty($_FILES["cover"]["name"])) {
                    $mediaRepository = new MediaPostRepository();
                    $media = new MediaPostType();
                    $persist_media = $media->submit($_FILES, $result);
                    $mediaRepository->flush($persist_media);
                }

                if ($result) {

                    $this->message('Saved. <a href="/posts">Go To Posts</a>', 'success', 'post_created');
                }
            }

            $this->display('app/post/form.tpl', ['form'=>$postForm]);
        }
        else
        {
            header("Refresh:0; url=/login");
            exit;
        }

    }
}