<?php

namespace App\Form;

use DOMDocument;
use DOMException;
class FormType
{
    private string $class;
    private string $id;
    private bool $required;
    private string $element;

    /**
     * @throws DOMException
     */
    public function add(): DOMDocument
    {
        $dom = new DOMDocument('1.0');
        $input = $dom->createElement('input');
        $domAttribute = $dom->createAttribute('type');
        $domAttribute->value = 'text';
        $input->appendChild($domAttribute);
        $domAttribute = $dom->createAttribute('name');
        $domAttribute->value = 'e-mail';
        $input->appendChild($domAttribute);
        $dom->appendChild($input);

        return $dom;

//        $input = sprintf('<input name="%1$s" type="%2$s" %3$s id="%1$s" required/>', $child, $type, $this->getClass());
//
//        if ($label)
//        {
//            return sprintf('<label for="%1$s" class="form-label">%2$s</label>', $child, $label) . $input;
//        }
//        else
//        {
//            return $input;
//        }

    }

}