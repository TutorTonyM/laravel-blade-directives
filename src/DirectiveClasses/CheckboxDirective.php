<?php


namespace TutorTonyM\BladeDirectives\DirectiveClasses;


class CheckboxDirective extends BaseDirective
{
    public function make(string $string, bool $isRequired = false, string $wrapper = null)
    {
        $stringIsNotEmpty = $string == '' ? false : true;
        $inputType = "type='checkbox'";
        $required = $isRequired ? "required" : null;
        $hidden = null;
        $label = null;
        $validationError = null;
        $data = $this->helper->attributePlacer([$inputType, $required]);
        $elements = "<input $data>$label";
        $wrapperTags = $this->helper->wrapper($wrapper, "checkbox");
        $wrapperStart = $wrapperTags['start'];
        $wrapperEnd = $wrapperTags['end'];
        $wrapperClass = $wrapperTags['class'];
        $wrapperErrorClass = $wrapperTags['error'];

        if ($stringIsNotEmpty){
            $validHtmlParameters = ['name', 'label', 'class', 'id', 'attribute', 'value', 'oldValue', 'hiddenInput', 'checked', 'place', 'variable', 'validation', 'classes', 'attributes'];

            $givenHtmlParameters = explode(',', $string);

            $stringSections = $this->helper->htmlParametersAssigner($givenHtmlParameters, $validHtmlParameters);
            $stringSections['class'] = $this->helper->wrapperClass($stringSections, $wrapperClass);

            $hidden = $this->elements->checkboxHiddenInputCreator($stringSections, 'hidden');
            $id = $this->autoId ? $this->attributes->autoId($stringSections) : $this->attributes->id($stringSections);
            $labeling = $this->elements->labeling($stringSections, $this->labeling, $this->autoLabel, $isRequired, $id, 'checkbox');
            $label = $labeling['label'];
            $name = $this->attributes->name($stringSections);
            $class = $this->attributes->class($stringSections);
            $attribute = $this->attributes->attribute($stringSections);
            $value = $this->attributes->value($stringSections, '1');
            $oldValue = $this->validation->oldValueCheckbox($stringSections);
            $checked = $this->attributes->checked($stringSections);
            $inputType = isset($stringSections['type']) ? $this->attributes->type($stringSections) : $inputType;
            $data = $this->helper->attributePlacer([$id, $inputType, $class, $name, $value, $oldValue, $checked, $attribute, $required]);
            $elements = $this->helper->twoTagsOrganizer($stringSections, 'place', "<input $data>", $label);
            $validationError = $this->validation->inputValidationError($stringSections, $wrapperErrorClass);
        }

        return "
            $wrapperStart
            $hidden
            $elements
            $validationError
            $wrapperEnd
        ";
    }
}