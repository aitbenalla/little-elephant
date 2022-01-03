<?php

namespace App\Form;

use App\Entity\Post;
use App\Model\CategoryRepository;
use DOMException;
use stdClass;

class PostType extends FormType
{
    /**
     * @throws DOMException
     */
    public function buildForm(Post $post=null): stdClass
    {
        $builder = new stdClass();
        $media = new MediaPostType();

        $builder->cover = $media->buildForm()->cover;
        $builder->title = $this->add('text','title', ['class'=>'form-control', 'required'=>true, 'label'=>'Title:','placeholder'=>'Post Title',
             'value' => ($post ? $post->getTitle() : '')]);
        $builder->slug = $this->add('text','slug', ['class'=>'form-control', 'required'=>true, 'label'=>'Slug:','placeholder'=>'Post URL',
            'value' => ($post ? $post->getSlug() : '')]);
        $builder->categories = $this->add('select','categories', ['class'=>'form-select','entity'=>['category'=>$this->getCategories()], 'label'=>'Categories:',
            'entity-value' => ($post ? $post->category_id : '')]);
        $builder->content = $this->add('textarea','content', ['class'=>'form-control', 'required'=>true, 'label'=>'Content:',
            'textarea-value' => ($post ? $post->getContent() : '')]);
        $builder->tags = $this->add('text','tags', ['class'=>'form-control', 'label'=>'Tags:', 'placeholder'=>'Add Tags',
            'value' => ($post ? $post->getTags() : '')]);
        return $builder;
    }

    public function submit($data): Post
    {
        $post = new Post();
        $post->setAuthor($_SESSION['author']->getId());

        foreach ($data as $key => $value) {
            switch ($key) {
                case 'title':
                    $post->setTitle($value);
                    break;
                case 'content':
                    $post->setContent($value);
                    break;
                case 'slug':
                    $post->setSlug($value);
                    break;
                case 'status':
                    if ($value)
                    {
                        $post->setStatus(1);
                    }
                    break;
                case 'categories':
                    $post->setCategory($value);
                    break;
                case 'tags':
                    $tags = explode(',',$value);
                    $post->setTags(json_encode($tags));
                    break;
            }
        }

        return $post;
    }

    private function getCategories(): bool|array|string
    {
        $repository = new CategoryRepository();

        return $repository->getAll();

    }
}