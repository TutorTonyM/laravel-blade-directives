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
        $id = $this->helper->between($id, '"');
        $for = is_null($id) ? null : "for='$id'";
        return $this->elementMaker($parametersArray, 'label', 'label', $for, $addon);
    }

    public function autoLabel(array $parametersArray, bool $isRequired, string $id)
    {
        $required = $isRequired ? config('ttm-blade-directives.required_field_marker') : null;
        $label = isset($parametersArray['label']) ? $parametersArray['label'] : false;
        if ($label && !is_null($value = $this->helper->nullOrValue($label))){
            return $this->label($parametersArray, $isRequired, $id);
        }
        $section = isset($parametersArray['name']) ? $parametersArray['name'] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            $id = $this->helper->between($id, '"');
            $value = Str::title(str_replace(['_', '-'], ' ', Str::kebab($value)));
            return "<label for='$id'>$value$required</label>";
        }
        return null;
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

    public function labeling(array $parametersArray, string $id, string $labeling, bool $autoLabel, bool $isRequired)
    {
        $result = [];

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

        return $result;
    }
}