<?php


namespace TutorTonyM\BladeDirectives\DirectiveClasses;


class SelectDirective extends BaseDirective
{
    public function make(string $string, bool $isRequired = false, string $wrapper = null)
    {
        $stringIsNotEmpty = $string == '' ? false : true;
        $required = $isRequired ? "required" : null;
        $label = null;
        $validationError = null;
        $default = null;
        $options = null;
        $data = $required;
        $wrapperTags = $this->helper->wrapper($wrapper);
        $wrapperStart = $wrapperTags['start'];
        $wrapperEnd = $wrapperTags['end'];
        $wrapperClass = $wrapperTags['class'];
        $wrapperErrorClass = $wrapperTags['error'];

        if ($stringIsNotEmpty){
            $validHtmlParameters = ['name', 'label', 'class', 'id', 'attribute', 'options', 'selected', 'oldValue', 'collection', 'variable', 'validation', 'classes', 'attributes', 'defaultOption'];
            $validHtml2Parameters = ['class', 'id', 'attribute', 'classes', 'attributes'];
            $stringArray = explode('|', $string);
            $givenHtmlParameters = explode(',', $stringArray[0]);
            $hasHtml2 = isset($stringArray[1]);
            $givenHtml2Parameters = $hasHtml2 ? explode(',', $stringArray[1]) : null ;

            $stringSections = $this->helper->htmlParametersAssigner($givenHtmlParameters, $validHtmlParameters);
            $stringSections['class'] = $this->helper->wrapperClass($stringSections, $wrapperClass);
            if ($hasHtml2) $stringSections = $stringSections + $this->helper->htmlParametersassigner($givenHtml2Parameters, $validHtml2Parameters, 2);

            $id = $this->autoId ? $this->attributes->autoId($stringSections) : $this->attributes->id($stringSections);
            $labeling = $this->elements->labeling($stringSections, $this->labeling, $this->autoLabel, $isRequired, $id, 'select');
            $label = $labeling['label'];
            $default = $labeling['placeholder'];
            $name = $this->attributes->name($stringSections);
            $class = $this->attributes->class($stringSections);
            $attribute = $this->attributes->attribute($stringSections);
            $options = $this->elements->options($stringSections);
            $data = $this->helper->attributePlacer([$id, $class, $name, $attribute, $required]);
            $validationError = $this->validation->inputValidationError($stringSections, $wrapperErrorClass);
        }

        return "
            $wrapperStart
            $label
            <select $data>
                $default
                $options
            </select>
            $validationError
            $wrapperEnd
        ";
    }
}