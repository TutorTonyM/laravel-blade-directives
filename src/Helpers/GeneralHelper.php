<?php


namespace TutorTonyM\BladeDirectives\Helpers;

use Illuminate\Support\Str;

class GeneralHelper
{
//    Verified
    public function nullOrValue($value)
    {
        $item = $value ?? null;
        $item = trim($item);
        $item = $item == null || $item == 'null' || $item == 'Null' || $item == 'NULL' ? null : $item;
        return $item;
    }

    public function isOff($value)
    {
        $response = false;
        $offSwitches = ['0', 'false', 'False', 'FALSE', 'off', 'Off', 'OFF', 'no', 'No', 'NO'];
        if (in_array(trim($value), $offSwitches)) $response = true;
        return $response;
    }

    public function isOn($value)
    {
        $response = false;
        $offSwitches = ['1', 'true', 'True', 'TRUE', 'on', 'On', 'ON', 'yes', 'Yes', 'YES'];
        if (in_array(trim($value), $offSwitches)) $response = true;
        return $response;
    }

    public function between($string, $start, $end = null)
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

    public function htmlParametersAssigner($givenParametersArray, $validParametersArray, $append = null)
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

    private function escapeEquals($string)
    {
        return str_replace('\=', '^', $string);
    }

    private function insertEquals($string){
        return str_replace('^', '=', trim($string));
    }
}