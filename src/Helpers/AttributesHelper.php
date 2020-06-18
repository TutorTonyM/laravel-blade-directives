<?php


namespace TutorTonyM\BladeDirectives\Helpers;

use Illuminate\Support\Str;
use function Couchbase\defaultDecoder;

class AttributesHelper
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new GeneralHelper();
    }

    public function action(array $parametersArray)
    {
        $section = isset($parametersArray['action']) ? $parametersArray['action'] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            if (Str::startsWith($value, '/')) return "action='$value'";
            if (Str::startsWith($value, '*')) return "action='".Str::replaceFirst('*', '', $value)."'";
            return "action='<?php echo e(route('$value')); ?>'";
        }
        return null;
    }

    public function singleId(string $value)
    {
        $array = explode(' ', $value);
        $id = trim($array[0]);
        return isset($id) ? $id : null;
    }

    public function class(array $parametersArray)
    {
        return $this->attributeAndValue($parametersArray, 'class');
    }

    public function name(array $parametersArray)
    {
        return $this->attributeAndValue($parametersArray, 'name');
    }

    public function value(array $parametersArray)
    {
        return $this->attributeAndValue($parametersArray, 'value');
    }

    public function type(array $parametersArray)
    {
        return $this->attributeAndValue($parametersArray, 'type');
    }

    public function id(array $parametersArray)
    {
        return $this->attributeAndValue($parametersArray, 'id');
    }

    public function autoId(array $parametersArray)
    {
        $id = isset($parametersArray['id']) ? $parametersArray['id'] : false;
        if ($id && !is_null($value = $this->helper->nullOrValue($id))){
            return "id='$value'";
        }
        $section = isset($parametersArray['name']) ? $parametersArray['name'] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            return "id='$value'";
        }
        return null;
    }

    public function placeholder(array $parametersArray, bool $isRequired)
    {
        $addon = $isRequired ? config('ttm-blade-directives.required_field_marker') : null;
        return $this->attributeAndValue($parametersArray, 'label', $addon);
    }

    public function autoPlaceholder(array $parametersArray, bool $isRequired)
    {
        $required = $isRequired ? config('ttm-blade-directives.required_field_marker') : null;
        $placeholder = isset($parametersArray['label']) ? $parametersArray['label'] : false;
        if ($placeholder && !is_null($value = $this->helper->nullOrValue($placeholder))){
            return "placeholder='$value$required'";
        }
        $section = isset($parametersArray['name']) ? $parametersArray['name'] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            $value = Str::title(str_replace(['_', '-'], ' ', Str::kebab($value)));
            return "placeholder='$value$required'";
        }
        return null;
    }

    public function attribute(array $parametersArray)
    {
        return $this->verbatim($parametersArray, 'attribute');
    }

    public function method(array $parametersArray)
    {
        $section = isset($parametersArray['method']) ? $parametersArray['method'] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            $method = 'POST';
            if ($value == 'get' || $value == 'GET') $method = 'GET';
            return "method='$method'";
        }
        return null;
    }

    private function attributeAndValue(array $parametersArray, string $parameter, string $default = null, string $remove = null)
    {
        $section = isset($parametersArray[$parameter]) ? $parametersArray[$parameter] : false;
        if (!$section && !is_null($default)) $section = $default;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            if (!is_null($remove)) {$parameter = substr($parameter, 0, strrpos($parameter, (string)$remove));}
            if ($parameter == 'id') $value = $this->singleId($value);
            return "$parameter='$value'";
        }
        return null;
    }

    private function verbatim(array $parametersArray, string $parameter, bool $isSwitch = false, bool $switchCheck = true)
    {
        $section = isset($parametersArray[$parameter]) ? $parametersArray[$parameter] : false;

        if ($isSwitch){
            if ($switchCheck){
                if ($section && $this->helper->isOn($section)){
                    return $parameter;
                }
            }
            else{
                if ($section && $this->helper->isOff($section)){
                    return $parameter;
                }
            }
        }
        else{
            if ($section && !is_null($value = $this->helper->nullOrValue($section))){
                return "$value";
            }
        }

        return null;
    }
}