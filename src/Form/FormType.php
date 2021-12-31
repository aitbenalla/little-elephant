<?php

namespace App\Form;

use DOMDocument;
use DOMException;
class FormType
{
    /**
     * @throws DOMException
     */
    public function add(string $type,string $name, $options = []): bool|string
    {
        return $this->create($type, $name, $options)->saveHTML();
    }

    /**
     * @throws DOMException
     */
    public function create(string $type, string $name, array $options): DOMDocument | bool
    {
        $dom = new DOMDocument('1.0');

        switch ($type)
        {
            case 'text':
                $element = $dom->createElement('input');
                $this->createAttr($dom, $element, 'type', 'text');
                break;
            case 'file':
                $element = $dom->createElement('input');
                $this->createAttr($dom, $element, 'type', 'file');
                break;
            case 'tel':
                $element = $dom->createElement('input');
                $this->createAttr($dom, $element, 'type', 'tel');
                break;
            case 'select':
                $element = $dom->createElement('select');
                foreach ($options['data'] as $val)
                {
                    $option = $dom->createElement('option', $val);
                    $this->createAttr($dom, $option, 'value', $val);
                    $element->appendChild($option);
                }
                break;
        }

        if (isset($element))
        {
            $this->createAttr($dom, $element, 'id', $name);
            $this->createAttr($dom, $element, 'name', $name);

            if (!empty($options))
            {
                foreach ($options as $key => $val) {
                    switch ($key)
                    {
                        case 'class':
                            $this->createAttr($dom, $element, 'class', $val);
                            break;
                        case 'required':
                            if ($val)
                                $this->createAttr($dom, $element, 'required');
                                break;
                        case 'placeholder':
                            $this->createAttr($dom, $element, 'placeholder', $val);
                            break;
                        case 'label':
                            $this->createLabel($dom, $val,$name);
                            break;

                    }
                }
            }

            $dom->appendChild($element);

            return $dom;
        }

        return false;

    }

    private function createAttr($dom, $element, $attr, $val = null)
    {
        $domAttribute = $dom->createAttribute($attr);
        if ($val)
        {
            $domAttribute->value = $val;
        }
        $element->appendChild($domAttribute);
    }

    private function createLabel($dom, $val,$name)
    {
        $label = $dom->createElement('label', $val);
        $this->createAttr($dom, $label, 'for',$name);
        $this->createAttr($dom, $label, 'class','form-label');
        $dom->appendChild($label);
    }


}