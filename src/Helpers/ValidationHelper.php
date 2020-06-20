<?php


namespace TutorTonyM\LaravelBladeDirectives\Helpers;


class ValidationHelper
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new GeneralHelper();
    }

    public function inputValidationError(array $stringSections, bool $lightMode = false)
    {
        $validationError = null;
        $class = config('ttm-blade-directives.validation_error_message_class');

        if ($lightMode){
            $name = $stringSections[0];
            $validationError = '
                <?php 
                    if($errors->has("' . $name . '")){
                        echo"
                            <span class=\"'.$class.'\">
                                <strong>".$errors->first("' . $name . '")."</strong>
                            </span>
                        ";
                    }
                ?>
            ';
        }
        else{
            $validation = isset($stringSections['validation']) ? $stringSections['validation'] : false;
            $name = isset($stringSections['name']) ? $stringSections['name'] : false;
            if ($validation) $class = $this->helper->isOff($validation) ? false : $validation;

            if ($name && $class) {
                $validationError = '
                    <?php 
                        if($errors->has("' . $name . '")){
                            echo"
                                <span class=\"'.$class.'\">
                                    <strong>".$errors->first("' . $name . '")."</strong>
                                </span>
                            ";
                        }
                    ?>
                ';
            }
        }

        return $validationError;
    }

    public function oldValueInput(array $stringSections)
    {
        $value = isset($stringSections['value']) ? $stringSections['value'] : false;
        $name = isset($stringSections['name']) ? $stringSections['name'] : false;
        $variable = isset($stringSections['variable']) ? $stringSections['variable'] : false;

        if ($value && $this->helper->isOff($value)){
            return null;
        }

        if ($value && !is_null($this->helper->nullOrValue($value))){
            return "value='$value'";
        }

        if ($variable){
            if (($name && !$value) || ($name && is_null($this->helper->nullOrValue($value)))){
                return "value='<?php echo e(old(\"$name\") ?? $$variable->$name); ?>'";
            }
        }

        if (($name && !$value) || ($name && is_null($this->helper->nullOrValue($value)))){
            return "value='<?php echo e(old(\"$name\")); ?>'";
        }

        return null;
    }
}