<?php

namespace TableOfContents\Elements;

use DNADesign\Elemental\Models\BaseElement;

class TableOfContentsElement extends BaseElement
{
    private static $singular_name = 'Inhaltsverzeichnis';
    private static $plural_name = 'Inhaltsverzeichnisse';

    private static $defaults = [
        'ShowInMenu' => '0',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'MenuTitle',
            'ShowInMenu',
        ]);

        return $fields;
    }

    public function ElementsOnPage()
    {
        if (!$this->getPage()) {
            return null;
        }
        if (!$this->getPage()->hasMethod('ElementalArea')) {
            return null;
        }
        $elements = $this->getPage()->ElementalArea()->Elements()->filter([
            'ClassName:not' => self::class,
            'ShowInMenu' => 1
        ]);
        $this->extend('updateElementsOnPage', $elements);
        return $elements;
    }
}
