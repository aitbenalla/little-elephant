<?php

namespace App\Form;

use App\Entity\MediaPost;
use DOMException;
use stdClass;

class MediaPostType extends FormType
{
    /**
     * @throws DOMException
     */
    public function buildForm(): stdClass
    {
        $builder = new stdClass();

        $builder->cover = $this->add('file','cover', ['class'=>'form-control', 'label'=>'Cover:']);

        return $builder;
    }

    public function submit(Array $data, int $id): MediaPost
    {
        $media = new MediaPost();
        $imgData = file_get_contents($_FILES['cover']['tmp_name']);
        $imgName = basename($_FILES["cover"]["name"]);
        $imgType = pathinfo($imgName, PATHINFO_EXTENSION);

        $media->setName($imgData);
        $media->setType($imgType);
        $media->setPost($id);

        return $media;
    }
}