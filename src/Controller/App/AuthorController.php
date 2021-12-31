<?php

namespace App\Controller\App;

use App\Controller\Controller;
use App\Entity\Author;
use App\Entity\MediaAuthor;
use App\Form\AuthorType;
use App\Model\AuthorRepository;
use App\Model\MediaAuthorRepository;
use JetBrains\PhpStorm\NoReturn;
use SmartyException;
class AuthorController extends Controller
{
    /**
     * @throws SmartyException
     */
    public function show()
    {
        $repository = new AuthorRepository();
        $this->display('app/author/show.tpl', ['authors' => $repository->getAll()]);
    }

    /**
     * @throws SmartyException
     */
    public function register($id = null)
    {
        $repository = new AuthorRepository();
        $form = new AuthorType();
        $author = new Author();

        if (isset($_POST['save'])) {

            $result = $repository->flush($author);

            if ($result && !empty($_FILES["photo"]["name"])) {
                $media = new MediaAuthor();
                $mediaRepository = new MediaAuthorRepository();
                $imgData = file_get_contents($_FILES['photo']['tmp_name']);
                $imgName = basename($_FILES["photo"]["name"]);
                $imgType = pathinfo($imgName, PATHINFO_EXTENSION);

                $media->setName($imgData);
                $media->setType($imgType);
                $media->setAuthor($result);

                $mediaRepository->flush($media, $id);
            }

            if ($result) {

                $this->flash('Saved. <a href="app/author/show">Go To List</a>', 'success', 'au_saved');
            }
        }

        $this->display('app/author/register.tpl', ['form'=>$form->buildForm()]);
    }

    /**
     * @throws SmartyException
     */
    #[NoReturn]
    public function profile($username)
    {
        $repository = new AuthorRepository();
        $profile = $repository->getOneByUsername($username);

        if (is_object($profile))
        {
            $this->display('app/author/profile.tpl', ['profile'=>$profile]);
        }
        else
        {
            $this->flash('Profile not found', 'danger', 'profile_not_found');
            header("Refresh:0; url=/");
            exit;
        }

    }
}