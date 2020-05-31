<?php


namespace TutorTonyM\BladeDirectives\Helpers;

use Illuminate\Support\Str;

class AttributesHelper
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new GeneralHelper();
    }

    public function action($parametersArray)
    {
        $section = isset($parametersArray['action']) ? $parametersArray['action'] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            if (Str::startsWith($value, '/')) return "action='$value'";
            if (Str::startsWith($value, '*')) return "action='".Str::replaceFirst('*', '', $value)."'";
            return "action='<?php echo e(route('$value')); ?>'";
        }
        return null;
    }

    public function singleId($value)
    {
        $array = explode(' ', $value);
        $id = trim($array[0]);
        return isset($id) ? $id : null;
    }

    public function class($parametersArray)
    {
        return $this->attributeAndValue($parametersArray, 'class');
    }

    public function name($parametersArray)
    {
        return $this->attributeAndValue($parametersArray, 'name');
    }

    public function placeholder($parametersArray)
    {
        return $this->attributeAndValue($parametersArray, 'placeholder');
    }

    public function value($parametersArray)
    {
        return $this->attributeAndValue($parametersArray, 'value');
    }

    public function type($parametersArray)
    {
        return $this->attributeAndValue($parametersArray, 'type');
    }

    public function id($parametersArray, $parameter = 'id')
    {
        return $this->attributeAndValue($parametersArray, $parameter);
    }

    public function autoId($parametersArray)
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

    public function attribute($parametersArray)
    {
        return $this->verbatim($parametersArray, 'attribute');
    }

    public function method($parametersArray)
    {
        $section = isset($parametersArray['method']) ? $parametersArray['method'] : false;
        if ($section && !is_null($value = $this->helper->nullOrValue($section))){
            $method = 'POST';
            if ($value == 'get' || $value == 'GET') $method = 'GET';
            return "method='$method'";
        }
        return null;
    }

    private function attributeAndValue($parametersArray, $parameter, $default = null, $remove = null)
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

    private function verbatim($parametersArray, $parameter, $isSwitch = false, $switchCheck = true)
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