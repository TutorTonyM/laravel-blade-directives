<?php


namespace TutorTonyM\BladeDirectives\Helpers;


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
                $attributes = $attributesValue ?? null;

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

    public function label(array $parametersArray, string $id = null)
    {
        $id = $this->helper->between($id, '"');
        $for = is_null($id) ? null : "for='$id'";
        return $this->elementMaker($parametersArray, 'label', 'label', $for);
    }

    public function autoLabel(array $parametersArray, string $id)
    {
        $label = isset($parametersArray['label']) ? $parametersArray['label'] : false;
        if ($label && !is_null($value = $this->helper->nullOrValue($label))){
            return $this->label($parametersArray, $id);
        }
        $section = isset($parametersArray['name']) ? $parametersArray['name'] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            $id = $this->helper->between($id, '"');
            return "<label for='$id'>$value</label>";
        }
        return null;
    }

    private function elementMaker(array $parametersArray, string $parameter, string $defaultElement = 'div', string $additionalAttributes = null)
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
                $attributes = $attributesValue ?? null;

                $tag = trim($tagData);
                $tag = str_replace(['.', '#', '[', ']', $classValue, $idValue, $attributesValue],'', $tag);
                $tag = $tag == 'l' ? 'label' : $tag;
                $value = trim($titleArray[1]);

                return "<$tag $id $class $attributes $additionalAttributes>$value</$tag>";
            }
            else{
                return "<$defaultElement $additionalAttributes>$value</$defaultElement>";
            }
        }
        return null;
    }
}