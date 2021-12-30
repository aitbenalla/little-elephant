<?php

namespace App\Form;

use stdClass;
class AuthorType extends FormType
{
    public function buildForm()
    {
//        $builder->full_name = $this->add('full_name', 'text', 'Full Name' , ['class'=>'form-control','required'=>true]);
//        $builder->username = $this->add('username', 'text', 'form-control' , 'Username');
//        $builder->birth_date = $this->add('birth_date', 'date', 'form-control' , 'Birth Date');
//        $builder->email = $this->add('email', 'email', 'form-control' , 'Email');
//        $builder->phone = $this->add('phone', 'tel', 'form-control' , 'Phone');
//        $builder->password = $this->add('password', 'password', 'form-control' , 'Password');
//        $builder->password_repeat = $this->add('password_repeat', 'password', 'form-control' , 'Repeat Password');
//        $builder->address = $this->add('address', 'text', 'form-control' , 'Address');

        return $this->add()->saveHTML();
    }
}