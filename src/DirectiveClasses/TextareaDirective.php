<?php


namespace TutorTonyM\BladeDirectives\DirectiveClasses;


class TextareaDirective extends BaseDirective
{
    public function make(string $string, bool $isRequired = false, string $wrapper = null)
    {
        $stringIsNotEmpty = $string == '' ? false : true;
        $required = $isRequired ? "required" : null;
        $label = null;
        $oldValue = null;
        $validationError = null;
        $data = $required;
        $wrapperTags = $this->helper->wrapper($wrapper);
        $wrapperStart = $wrapperTags['start'];
        $wrapperEnd = $wrapperTags['end'];
        $wrapperClass = $wrapperTags['class'];
        $wrapperErrorClass = $wrapperTags['error'];

        if ($stringIsNotEmpty){
            $validHtmlParameters = ['name', 'label', 'class', 'id', 'attribute', 'oldValue', 'variable', 'validation', 'classes', 'attributes', 'placeholder'];
            $validLogicParameters = ['variable', 'validation'];

            $givenHtmlParameters = explode(',', $string);

            $stringSections = $this->helper->htmlParametersAssigner($givenHtmlParameters, $validHtmlParameters);
            $stringSections['class'] = $this->helper->wrapperClass($stringSections, $wrapperClass);

            $id = $this->autoId ? $this->attributes->autoId($stringSections) : $this->attributes->id($stringSections);
            $labeling = $this->elements->labeling($stringSections, $this->labeling, $this->autoLabel, $isRequired, $id);
            $label = $labeling['label'];
            $placeholder = $labeling['placeholder'];
            $name = $this->attributes->name($stringSections);
            $class = $this->attributes->class($stringSections);
            $attribute = $this->attributes->attribute($stringSections);
            $oldValue = $this->validation->oldValueTextarea($stringSections);
            $data = $this->helper->attributePlacer([$id, $class, $name, $placeholder, $attribute, $required]);
            $validationError = $this->validation->inputValidationError($stringSections, $wrapperErrorClass);
        }

        return "
            $wrapperStart
            $label
            <textarea $data>$oldValue</textarea>
            $validationError
            $wrapperEnd
        ";
    }
}