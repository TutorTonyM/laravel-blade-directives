<?php


namespace TutorTonyM\BladeDirectives\DirectiveClasses;


class LabelDirective extends BaseDirective
{
    public function make(string $string)
    {
        $stringIsNotEmpty = $string == '' ? false : true;
        $text = null;
        $data = null;

        if ($stringIsNotEmpty){
            $validHtmlParameters = ['text', 'for', 'class', 'id', 'attribute', 'classes', 'attributes'];
            $givenHtmlParameters = explode(',', $string);

            $stringSections = $this->helper->htmlParametersAssigner($givenHtmlParameters, $validHtmlParameters);

            $for = $this->attributes->for($stringSections);
            $id = $this->autoId ? $this->attributes->autoId($stringSections) : $this->attributes->id($stringSections);
            $class = $this->attributes->class($stringSections);
            $attribute = $this->attributes->attribute($stringSections);
            $text = $this->attributes->text($stringSections);
            $data = $this->helper->attributePlacer([$id, $for, $class, $attribute]);
        }

        return "
            <label $data>$text</label>
        ";
    }
}