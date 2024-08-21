<?php

namespace TableOfContents\Extensions;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class BaseElementExtension extends DataExtension
{
    private static $db = [
        'ShowInMenu' => 'Boolean(1)',
        'MenuTitle' => 'Text',
    ];

    private static $defaults = [
        'ShowInMenu' => '1',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.Settings', [
            CheckboxField::create('ShowInMenu', 'Im Inhaltsverzeichnis anzeigen?'),
            TextField::create('MenuTitle', 'Titel im Inhaltsverzeichnis')
                ->setDescription('Wenn leer, wird der Titel aus dem Reiter "Inhalt" verwendet.'),
        ]);
    }

    public function MenuTitle()
    {
        $menuTitle = $this->owner->MenuTitle;

        if (empty($menuTitle)) {
            $menuTitle = $this->owner->Title;
        }

        $this->owner->extend('updateMenuTitle', $menuTitle);

        return $menuTitle;
    }

    public function updateExtraClass(&$extraClass)
    {
        if($this->owner->ShowInMenu){
            $extraClass .= ' show-in-menu';
        }
        return $extraClass;
    }
}