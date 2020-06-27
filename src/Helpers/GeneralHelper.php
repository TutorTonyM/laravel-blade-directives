<?php


namespace TutorTonyM\BladeDirectives\Helpers;

use Illuminate\Support\Str;

class GeneralHelper
{
    public function nullOrValue(string $value)
    {
        $item = $value;
        $item = trim($item);
        $item = $item == null || $item == 'null' || $item == 'Null' || $item == 'NULL' ? null : $item;
        return $item;
    }

    public function isOff(string $value)
    {
        $response = false;
        $offSwitches = ['0', 'false', 'False', 'FALSE', 'off', 'Off', 'OFF', 'no', 'No', 'NO'];
        if (in_array(trim($value), $offSwitches)) $response = true;
        return $response;
    }

    public function isOn(string $value)
    {
        $response = false;
        $offSwitches = ['1', 'true', 'True', 'TRUE', 'on', 'On', 'ON', 'yes', 'Yes', 'YES'];
        if (in_array(trim($value), $offSwitches)) $response = true;
        return $response;
    }

    public function between(string $string, string $start, string $end = null)
    {
        $end = $end ?? $start;
        $ini = strpos($string, $start);
        if ($ini == 0) return null;
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        $result = substr($string, $ini, $len);
        if (!$result) return null;
        return $result;
    }

    public function htmlParametersAssigner(array $givenParametersArray, array $validParametersArray, string $append = null)
    {
        $array = [];

        foreach ($givenParametersArray as $key => $parameter){
            $parameterEscaped = $this->escapeEquals($parameter);
            $parameterArray = explode('=', $parameterEscaped);

            $firstPart = $this->insertEquals($parameterArray[0]);
            $secondPart = isset($parameterArray[1]) ? $this->insertEquals($parameterArray[1]) : false;

            if ($secondPart && in_array($firstPart, $validParametersArray)){
                if ($firstPart == 'classes') $firstPart = 'class';
                if ($firstPart == 'attributes') $firstPart = 'attribute';
                if ($firstPart == 'placeholder') $firstPart = 'label';
                if ($firstPart == 'options') $firstPart = 'option';
                $array[$firstPart.$append] = $secondPart;
            }
            else{
                foreach ($validParametersArray as $validIndex => $validParameter) {
                    if ($key === $validIndex) $array[$validParametersArray[$validIndex].$append] = $firstPart;
                }
            }
        }

        return $array;
    }

    public function attributePlacer(array $attributes)
    {
        $result = null;

        foreach ($attributes as $attribute) {
            if (!is_null($attribute)) $result .= ' '.$attribute;
        }

        return $result;
    }

    public function wrapper(string $wrapper = null, string $element = null)
    {
        $error = 'invalid-feedback ';
        $end = '</div>';

        switch ($element){
            case 'checkbox':
            case 'radio':
                $start = '<div class="form-group form-check">';
                $class = 'form-check-input ';
                break;
            default:
                $start = '<div class="form-group">';
                $class = 'form-control ';
                break;
        }

        $wrapperTags = [];
        switch ($wrapper){
            case 'b4':
                $wrapperTags['start'] = $start;
                $wrapperTags['end'] = $end;
                $wrapperTags['class'] = $class;
                $wrapperTags['error'] = $error;
                break;
            default:
                $wrapperTags['start'] = null;
                $wrapperTags['end'] = null;
                $wrapperTags['class'] = null;
                $wrapperTags['error'] = null;
        }
        return $wrapperTags;
    }

    public function wrapperClass(array $givenParametersArray, string $class = null)
    {

        if(!is_null($class) && isset($givenParametersArray['class']) && isset($givenParametersArray['name'])){
            return $class
                . '<?php if($errors->has("'.$givenParametersArray['name'].'")){ echo "is-invalid "; } ?>'
                . $givenParametersArray['class'];
        }
        elseif(!is_null($class) && isset($givenParametersArray['name'])){
            return $class . '<?php if($errors->has("'.$givenParametersArray['name'].'")){ echo "is-invalid "; } ?>';
        }
        elseif(!is_null($class) && isset($givenParametersArray['class'])){
            return $class . $givenParametersArray['class'];
        }
        elseif(!is_null($class)){
            return $class;
        }
        elseif (isset($givenParametersArray['class'])){
            return $givenParametersArray['class'];
        }
        else{
            return null;
        }
    }

    public function twoTagsOrganizer($parametersArray, $parameter, $static, $floater, $default = null)
    {
        $section = isset($parametersArray[$parameter]) ? $parametersArray[$parameter] : false;
        if (!$section && !is_null($default)) $section = $default;
        switch ($section){
            case 'left':
                return $floater.'&nbsp;'.$static;
                break;
            case 'right':
                return $static.'&nbsp;'.$floater;
                break;
            case 'over':
            case 'top':
                return $floater.'<br>'.$static;
                break;
            case 'under':
            case 'bottom':
                return $static.'<br>'.$floater;
                break;
            default:
                return $static.'&nbsp;'.$floater;
                break;
        }
    }

    private function escapeEquals(string $string)
    {
        return str_replace('\=', '^', $string);
    }

    private function insertEquals(string $string){
        return str_replace('^', '=', trim($string));
    }
}