<?php


namespace TutorTonyM\BladeDirectives\DirectiveClasses;


class InputDirective extends BaseDirective
{
    public function make(string $string, bool $isRequired = false, string $type = 'text', string $wrapper = null)
    {
        $stringIsNotEmpty = $string == '' ? false : true;
        $inputType = "type='$type'";
        $required = $isRequired ? "required" : null;
        $label = null;
        $validationError = null;
        $data = $this->helper->attributePlacer([$inputType, $required]);
        $wrapperTags = $this->helper->wrapper($wrapper);
        $wrapperStart = $wrapperTags['start'];
        $wrapperEnd = $wrapperTags['end'];
        $wrapperClass = $wrapperTags['class'];
        $wrapperErrorClass = $wrapperTags['error'];

        if ($stringIsNotEmpty){
            $validHtmlParameters = ['name', 'label', 'class', 'id', 'attribute', 'value', 'type', 'variable', 'validation', 'classes', 'attributes', 'placeholder'];

            $givenHtmlParameters = explode(',', $string);

            $stringSections = $this->helper->htmlParametersAssigner($givenHtmlParameters, $validHtmlParameters);
            $stringSections['type'] = isset($stringSections['type']) ? $stringSections['type'] : $type;
            $stringSections['class'] = $this->helper->wrapperClass($stringSections, $wrapperClass);

            $id = $this->autoId ? $this->attributes->autoId($stringSections) : $this->attributes->id($stringSections);
            $labeling = $this->elements->labeling($stringSections, $this->labeling, $this->autoLabel, $isRequired, $id);
            $label = $labeling['label'];
            $placeholder = $labeling['placeholder'];
            $name = $this->attributes->name($stringSections);
            $class = $this->attributes->class($stringSections);
            $attribute = $this->attributes->attribute($stringSections);
            $value = $this->validation->oldValueInput($stringSections);
            $inputType = isset($stringSections['type']) ? $this->attributes->type($stringSections) : $inputType;
            $data = $this->helper->attributePlacer([$id, $inputType, $class, $name, $value, $placeholder, $attribute, $required]);
            $validationError = $this->validation->inputValidationError($stringSections, $wrapperErrorClass);
        }

        return "
            $wrapperStart
            $label
            <input $data>
            $validationError
            $wrapperEnd
        ";
    }
}