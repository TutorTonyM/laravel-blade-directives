<?php


namespace TutorTonyM\BladeDirectives\DirectiveClasses;


class InputDirective extends BaseDirective
{
    public function make(string $string, bool $isRequired = false, string $type = 'text')
    {
        $stringIsNotEmpty = $string == '' ? false : true;
        $inputType = "type='$type'";
        $required = $isRequired ? "required" : null;
        $validationError = null;
        $data = $inputType;

        if ($stringIsNotEmpty){
            if ($this->fullMode){
                $validHtmlParameters = ['name', 'placeholder', 'class', 'id', 'attribute', 'value', 'type', 'classes', 'attributes'];
                $validLogicParameters = ['variable', 'validation'];

                $stringArray = explode('|', $string);
                $givenHtmlParameters = explode(',', $stringArray[0]);
                $hasLogic = isset($stringArray[1]);
                $givenLogicParameters = $hasLogic ? explode(',', $stringArray[1]) : null;

                $stringSections = $this->helper->htmlParametersAssigner($givenHtmlParameters, $validHtmlParameters);
                $stringSections['type'] = isset($stringSections['type']) ? $stringSections['type'] : $type;
                if ($hasLogic) $stringSections = $stringSections + $this->helper->htmlParametersAssigner($givenLogicParameters, $validLogicParameters);

                $name = $this->attributes->name($stringSections);
                $placeholder = $this->attributes->placeholder($stringSections);
                $class = $this->attributes->class($stringSections);
                $id = $this->autoId ? $this->attributes->autoId($stringSections) : $this->attributes->id($stringSections);
                $attribute = $this->attributes->attribute($stringSections);
                $value = $this->validation->oldValueInput($stringSections);
                $inputType = isset($stringSections['type']) ? $this->attributes->type($stringSections) : $inputType;
                $data = $this->helper->attributePlacer([$id, $inputType, $class, $name, $value, $placeholder, $attribute, $required]);
                $validationError = $this->validation->inputValidationError($stringSections);
            }
            else{
                $stringArray = explode('|', $string);
                $givenHtmlParameters = explode(',', $stringArray[0]);
                $hasLogic = isset($stringArray[1]);
                $givenLogicParameters = $hasLogic ? explode(',', $stringArray[1]) : null;

                $data = $this->helper->attributePlacer([$givenHtmlParameters, $required]);
                $validationError = $this->validation->inputValidationError($givenLogicParameters);
            }
        }

        return "
            <input $data>
            $validationError
        ";
    }
}