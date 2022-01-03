<?php

namespace App\Form;

use App\Entity\MediaAuthor;
use DOMException;
use stdClass;

class MediaAuthorType extends FormType
{
    /**
     * @throws DOMException
     */
    public function buildForm(): stdClass
    {
        $builder = new stdClass();

        $builder->name = $this->add('file','photo', ['class'=>'form-control', 'label'=>'Photo:']);

        return $builder;
    }

    public function submit($id = null): MediaAuthor
    {
        $media = new MediaAuthor();

        $imgData = file_get_contents($_FILES['photo']['tmp_name']);
        $imgName = basename($_FILES["photo"]["name"]);
        $imgType = pathinfo($imgName, PATHINFO_EXTENSION);

        $media->setName($imgData);
        $media->setType($imgType);
        $media->setAuthor($id);

        return $media;
    }

}