<?php


namespace TutorTonyM\BladeDirectives\Helpers;

use Illuminate\Support\Str;

class ElementsHelper
{
    protected $helper;
    protected $attributes;

    public function __construct()
    {
        $this->helper = new GeneralHelper();
        $this->attributes = new AttributesHelper();
    }

    public function title(array $parametersArray)
    {
        $section = isset($parametersArray['title']) ? $parametersArray['title'] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            $titleArray = explode(':', $value);
            if (count($titleArray) == 2){
                $tagData = $titleArray[0];

                $classValue = $this->helper->between($tagData, '.');
                $class = is_null($classValue) ? null : "class='$classValue'";

                $idValue = $this->helper->between($tagData, '#');
                $id = is_null($idValue) ? null : "id='".$this->attributes->singleId($idValue)."'";

                $attributesValue = $this->helper->between($tagData, '[', ']');
                $attributes = $attributesValue;

                $tag = trim($tagData);
                $tag = str_replace(['.', '#', '[', ']', $classValue, $idValue, $attributesValue],'', $tag);
                $value = trim($titleArray[1]);

                return "<$tag $id $class $attributes>$value</$tag>";
            }
            else{
                return "<h1>$value</h1>";
            }
        }
        return null;
    }

    public function spoof(array $parametersArray)
    {
        $section = isset($parametersArray['method']) ? $parametersArray['method'] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            $spoof = null;
            switch ($value){
                case 'put':
                case 'PUT':
                    $spoof = 'PUT';
                    break;
                case 'patch':
                case 'PATCH':
                    $spoof = 'PATCH';
                    break;
                case 'delete':
                case 'DELETE':
                    $spoof = 'DELETE';
                    break;
            }
            return is_null($spoof) ? null : "<?php echo method_field('$spoof'); ?>";
        }
        return null;
    }

    public function csrf(array $parametersArray, bool $autoCsrf)
    {
        $section = isset($parametersArray['csrf']) ? $parametersArray['csrf'] : false;
        if ($section && $this->helper->isOff($section)){
            return null;
        }
        if ($section && $this->helper->isOn($section)){
            return "<?php echo csrf_field(); ?>";
        }
        if (!$autoCsrf){
            return null;
        }
        return "<?php echo csrf_field(); ?>";
    }

    public function label(array $parametersArray, bool $isRequired, string $id = null)
    {
        $addon = $isRequired ? config('ttm-blade-directives.required_field_marker') : null;
        $id = is_null($id) ? null : $this->helper->between($id, "'");
        $for = is_null($id) ? null : "for='$id'";
        return $this->elementMaker($parametersArray, 'label', 'label', $for, $addon);
    }

    public function autoLabel(array $parametersArray, bool $isRequired, string $id = null, bool $executeOnNull = true)
    {
        $required = $isRequired ? config('ttm-blade-directives.required_field_marker') : null;
        $label = isset($parametersArray['label']) ? $parametersArray['label'] : false;
        if ($label && !is_null($value = $this->helper->nullOrValue($label))){
            return $this->label($parametersArray, $isRequired, $id);
        }
        if ($executeOnNull){
            $section = isset($parametersArray['name']) ? $parametersArray['name'] : false;
            if ($section && !is_null($value = $this->helper->nullOrValue($section))){
                $id = $this->helper->between($id, "'");
                $value = Str::title(str_replace(['_', '-'], ' ', Str::kebab($value)));
                return "<label for='$id'>$value$required</label>";
            }
        }
        return null;
    }

    public function autoDefaultOption(array $parametersArray, bool $isRequired, string $id = null)
    {
        $label = isset($parametersArray['label']) ? $parametersArray['label'] : false;
        if ($label && !is_null($value = $this->helper->nullOrValue($label))){
            return $this->defaultOption($parametersArray, $isRequired);
        }
        return null;
    }

    public function defaultOption(array $parametersArray, bool $isRequired)
    {
        $addon = $isRequired ? config('ttm-blade-directives.required_field_marker') : null;
        return $this->elementMaker($parametersArray, 'label', 'option', 'selected disabled value=""', $addon);
    }

    public function options($parametersArray)
    {
        $collectionString = isset($parametersArray['collection']) ? $parametersArray['collection'] : false;
        if ($collectionString && !is_null($string = $this->helper->nullOrValue($collectionString))){
            $sub = 2;
            $collectionArray = explode(':', $collectionString);
            $collectionSection = $collectionArray[0];
            $oldValue = $this->optionSelected($parametersArray, 'oldValue');
            $variable = $this->optionSelected($parametersArray, 'variable');
            $class = $this->attributes->attributeAndValue($parametersArray, 'class'.$sub, null, $sub);
            $id = $this->attributes->attributeAndValue($parametersArray, 'id'.$sub, null, $sub);
            $attribute = $this->attributes->verbatim($parametersArray, 'attribute'.$sub);
            $collection = Str::startsWith($collectionSection, '$') ? $collectionSection : '$'.$collectionSection;
            $defaultValue = isset($collectionArray[1]) ? $collectionArray[1] : 'id';
            $value = ' value=\"$item->'.$defaultValue.'\"';
            $text = isset($collectionArray[2]) ? '$item->'.$collectionArray[2] : '$item->'.$defaultValue;
            $oldValueVar = $oldValue ? '$oldValue' : "";
            $variableVar = $variable ? '$variable' : "";
            $class = $class ? '$class = "'.$class.'";' : "";
            $classVar = $class ? '$class' : "";
            $id = $id ? '$id = "'.$id.'";' : "";
            $idVar = $id ? '$id' : "";
            $attribute = $attribute ? '$attribute = "'.$attribute.'";' : "";
            $attributeVar = $attribute ? '$attribute' : "";
            return '
                <?php
                    foreach ('.$collection.' as $item){
                    '.$oldValue.$variable.$class.$id.$attribute.'
                    
                        echo"
                            <option'.$value.$idVar.$classVar.$oldValueVar.$variableVar.$attributeVar.'>'.$text.'</option>
                        ";
                    }
                ?>
            ';
        }

        $optionsString = isset($parametersArray['option']) ? $parametersArray['option'] : false;
        $selectedOption = isset($parametersArray['selected']) ? $parametersArray['selected'] : null;
        if ($optionsString && !is_null($string = $this->helper->nullOrValue($optionsString))){
            $options = null;
            $optionsArray = explode(';', $string);
            foreach ($optionsArray as $item){
                $optionSections = explode(':', $item);
                $value = $optionSections[0];
                $text = isset($optionSections[1]) ? $optionSections[1] : $value;
                $selected = $this->optionSelector($value, $selectedOption);
                $option = "<option value='".Str::replaceFirst("*", "", $value)."'$selected>".Str::replaceFirst("*", "", $text)."</option>";
                $options .= $option;
            }
            return $options;
        }

        return null;
    }

    private function optionSelected($parametersArray, $parameter)
    {
        $result = false;
        $string = isset($parametersArray[$parameter]) ? $parametersArray[$parameter] : false;
        if ($string && $this->helper->isOff($string)){
            return $result;
        }
        $nameString = isset($parametersArray['name']) ? $parametersArray['name'] : false;
        if ($nameString && !is_null($name = $this->helper->nullOrValue($nameString))){
            if ($parameter == 'variable' && !$string) return $result;
            $value = isset($parametersArray['value']) ? $parametersArray['value'] : 'id';
            $compare = $parameter == 'variable' ? '$'.$string.'->'.$name : 'e(old("'.$name.'"))';
            $result = '$'.$parameter.' = '.$compare.' == $item->'.$value.' ? " selected" : "";';
        }
        return $result;
    }

    private function optionSelector($value, $selected)
    {
        if (Str::startsWith($value, '*') || $value == $selected) return " selected";
        return "";
    }

    private function elementMaker(array $parametersArray, string $parameter, string $defaultElement = 'div', string $additionalAttributes = null, string $addons = null)
    {
        $section = isset($parametersArray[$parameter]) ? $parametersArray[$parameter] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            $titleArray = explode(':', $value);
            if (count($titleArray) == 2){
                $tagData = $titleArray[0];

                $classValue = $this->helper->between($tagData, '.');
                $class = is_null($classValue) ? null : "class='$classValue'";

                $idValue = $this->helper->between($tagData, '#');
                $id = is_null($idValue) ? null : "id='".$this->attributes->singleId($idValue)."'";

                $attributesValue = $this->helper->between($tagData, '[', ']');
                $attributes = $attributesValue;

                $tag = trim($tagData);
                $tag = str_replace(['.', '#', '[', ']', $classValue, $idValue, $attributesValue],'', $tag);
                $tag = $tag == 'l' ? 'label' : $tag;
                $value = trim($titleArray[1]);

                return "<$tag $id $class $attributes $additionalAttributes>$value$addons</$tag>";
            }
            else{
                return "<$defaultElement $additionalAttributes>$value$addons</$defaultElement>";
            }
        }
        return null;
    }

    public function labeling(array $parametersArray, string $labeling, bool $autoLabel, bool $isRequired, string $id = null, string $element = null)
    {
        $result = [];
        $label = isset($parametersArray['label']) ? $parametersArray['label'] : false;
        if ($label && !is_null($value = $this->helper->nullOrValue($label))){
            $labelArray = explode(':', $value);
            $labelType = $labelArray[0];
        }

        if (($label && $labelType == 'label') || ($label && $labelType == 'l')){
            if (is_null($element)){
                $result['label'] = $autoLabel
                    ? $this->autoLabel($parametersArray, $isRequired, $id)
                    : $this->Label($parametersArray, $isRequired, $id);
                $result['placeholder'] = null;
            }
            elseif ($element == 'checkbox' || $element == 'radio'){
                $result['label'] = $autoLabel
                    ? $this->autoLabel($parametersArray, $isRequired, $id)
                    : $this->Label($parametersArray, $isRequired, $id);
                $result['placeholder'] = null;
            }
            elseif ($element == 'select'){
                $result['label'] = $autoLabel
                    ? $this->autoLabel($parametersArray, $isRequired, $id, false)
                    : $this->Label($parametersArray, $isRequired, $id);
                $result['placeholder'] = null;
            }
        }
        elseif (($label && $labelType == 'placeholder') || ($label && $labelType == 'p')){
            if (is_null($element)){
                if($labeling == 'placeholder'){
                    $result['label'] = null;
                    $result['placeholder'] = $autoLabel
                        ? $this->attributes->autoPlaceholder($parametersArray, $isRequired)
                        : $this->attributes->placeholder($parametersArray, $isRequired);
                }
            }
            elseif ($element == 'checkbox' || $element == 'radio'){
                $result['label'] = null;
                $result['placeholder'] = null;
            }
            elseif ($element == 'select'){
                if($labeling == 'placeholder'){
                    $result['label'] = null;
                    $result['placeholder'] = $autoLabel
                        ? $this->autoDefaultOption($parametersArray, $isRequired)
                        : $this->defaultOption($parametersArray, $isRequired);
                }
            }
        }
        else{
            if (is_null($element)){
                if ($labeling == 'label'){
                    $result['label'] = $autoLabel
                        ? $this->autoLabel($parametersArray, $isRequired, $id)
                        : $this->Label($parametersArray, $isRequired, $id);
                    $result['placeholder'] = null;
                }
                elseif($labeling == 'placeholder'){
                    $result['label'] = null;
                    $result['placeholder'] = $autoLabel
                        ? $this->attributes->autoPlaceholder($parametersArray, $isRequired)
                        : $this->attributes->placeholder($parametersArray, $isRequired);
                }
                elseif($labeling == 'both'){
                    $result['label'] = $autoLabel
                        ? $this->autoLabel($parametersArray, $isRequired, $id)
                        : $this->Label($parametersArray, $isRequired, $id);
                    $result['placeholder'] = $autoLabel
                        ? $this->attributes->autoPlaceholder($parametersArray, $isRequired)
                        : $this->attributes->placeholder($parametersArray, $isRequired);
                }
                else{
                    $result['placeholder'] = null;
                    $result['label'] = null;
                }
            }
            elseif ($element == 'checkbox' || $element == 'radio'){
                $result['label'] = $autoLabel
                    ? $this->autoLabel($parametersArray, $isRequired, $id)
                    : $this->Label($parametersArray, $isRequired, $id);
                $result['placeholder'] = null;
            }
            elseif ($element == 'select'){
                if ($labeling == 'label'){
                    $result['label'] = $autoLabel
                        ? $this->autoLabel($parametersArray, $isRequired, $id, false)
                        : $this->Label($parametersArray, $isRequired, $id);
                    $result['placeholder'] = null;
                }
                elseif($labeling == 'placeholder'){
                    $result['label'] = null;
                    $result['placeholder'] = $autoLabel
                        ? $this->autoDefaultOption($parametersArray, $isRequired)
                        : $this->defaultOption($parametersArray, $isRequired);
                }
                elseif($labeling == 'both'){
                    $result['label'] = $autoLabel
                        ? $this->autoLabel($parametersArray, $isRequired, $id, false)
                        : $this->Label($parametersArray, $isRequired, $id);
                    $result['placeholder'] = $autoLabel
                        ? $this->autoDefaultOption($parametersArray, $isRequired)
                        : $this->defaultOption($parametersArray, $isRequired);
                }
                else{
                    $result['placeholder'] = null;
                    $result['label'] = null;
                }
            }
        }

        return $result;
    }

    public function checkboxHiddenInputCreator(array $parametersArray, string $parameter)
    {
        $value = isset($parametersArray[$parameter]) ? $parametersArray[$parameter] : false;
        $name = isset($parametersArray['name']) ? $parametersArray['name'] : false;
        if ($value && $this->helper->isOff($value)){
            return null;
        }
        if ($name){
            return "<input type='hidden' name='$name' value='0'>";
        }
        return null;
    }
}