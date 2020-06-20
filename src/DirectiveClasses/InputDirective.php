<?php


namespace TutorTonyM\LaravelBladeDirectives\DirectiveClasses;


class InputDirective extends BaseDirective
{
    public function make(string $string, bool $isRequired = false, string $type = 'text', string $wrapper = null)
    {
        $stringIsNotEmpty = $string == '' ? false : true;
        $inputType = "type='$type'";
        $required = $isRequired ? "required" : null;
        $label = null;
        $placeholder = null;
        $validationError = null;
        $data = $inputType;
        $wrapperTags = $this->helper->wrapper($wrapper);
        $wrapperStart = $wrapperTags['start'];
        $wrapperEnd = $wrapperTags['end'];
        $wrapperClass = $wrapperTags['class'];

        if ($stringIsNotEmpty){
            $validHtmlParameters = ['name', 'label', 'class', 'id', 'attribute', 'value', 'type', 'classes', 'attributes', 'placeholder'];
            $validLogicParameters = ['variable', 'validation'];

            $stringArray = explode('|', $string);
            $givenHtmlParameters = explode(',', $stringArray[0]);
            $hasLogic = isset($stringArray[1]);
            $givenLogicParameters = $hasLogic ? explode(',', $stringArray[1]) : null;

            $stringSections = $this->helper->htmlParametersAssigner($givenHtmlParameters, $validHtmlParameters);
            $stringSections['type'] = isset($stringSections['type']) ? $stringSections['type'] : $type;
            $stringSections['class'] = $wrapperClass ?? null;
            if ($hasLogic) $stringSections = $stringSections + $this->helper->htmlParametersAssigner($givenLogicParameters, $validLogicParameters);

            $id = $this->autoId ? $this->attributes->autoId($stringSections) : $this->attributes->id($stringSections);
            $labeling = $this->elements->labeling($stringSections, $id, $this->labeling, $this->autoLabel, $isRequired);
            $label = $labeling['label'];
            $placeholder = $labeling['placeholder'];
            $name = $this->attributes->name($stringSections);
            $class = $this->attributes->class($stringSections);
            $attribute = $this->attributes->attribute($stringSections);
            $value = $this->validation->oldValueInput($stringSections);
            $inputType = isset($stringSections['type']) ? $this->attributes->type($stringSections) : $inputType;
            $data = $this->helper->attributePlacer([$id, $inputType, $class, $name, $value, $placeholder, $attribute, $required]);
            $validationError = $this->validation->inputValidationError($stringSections);
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