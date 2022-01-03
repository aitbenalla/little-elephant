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
        return $this->createElement($type, $name, $options)->saveHTML();
    }

    /**
     * @throws DOMException
     */
    public function createElement(string $type, string $name, array $options): DOMDocument | bool
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
            case 'date':
                $element = $dom->createElement('input');
                $this->createAttr($dom, $element, 'type', 'date');
                break;
            case 'password':
                $element = $dom->createElement('input');
                $this->createAttr($dom, $element, 'type', 'password');
                break;
            case 'select':
                $element = $dom->createElement('select');
                if (array_key_exists('data',$options))
                {
                    foreach ($options['data'] as $val)
                    {
                        $option = $dom->createElement('option', $val);
                        $this->createAttr($dom, $option, 'value', $val);
                        $element->appendChild($option);
                    }
                }
                if (array_key_exists('entity',$options))
                {
                    foreach ($options['entity'] as $key => $val)
                    {
                        if ($key === 'category')
                        {
                            foreach ($val as $entity)
                            {
                                $option = $dom->createElement('option', $entity->getName());
                                $this->createAttr($dom, $option, 'value', $entity->getId());

                                if (array_key_exists('entity-value',$options))
                                {
                                    if ($options['entity-value'] === $entity->getId())
                                    {
                                        $this->createAttr($dom, $option, 'selected');
                                    }

                                }
                                $element->appendChild($option);
                            }
                        }
                    }
                }
                break;
            case 'textarea':
                $element = $dom->createElement('textarea');
                if (array_key_exists('textarea-value',$options))
                {
                    $element = $dom->createElement('textarea', $options['textarea-value']);
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
                        case 'value':
                            $this->createAttr($dom, $element, 'value', $val);
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