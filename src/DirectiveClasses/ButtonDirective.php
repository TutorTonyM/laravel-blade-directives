<?php


namespace TutorTonyM\BladeDirectives\DirectiveClasses;


class ButtonDirective extends BaseDirective
{
    public function make(string $string, string $type = 'button', string $frameworkClasses = null)
    {
        $stringIsNotEmpty = $string == '' ? false : true;
        $text = $type == 'button'
            ? config('ttm-blade-directives.button_default_text')
            : config('ttm-blade-directives.submit_default_text');
        $buttonType = "type='$type'";
        $additionalClasses = is_null($frameworkClasses) ? null : "class='$frameworkClasses'";
        $data = $this->helper->attributePlacer([$buttonType, $additionalClasses]);

        if ($stringIsNotEmpty){
            $validHtmlParameters = ['text', 'name', 'class', 'id', 'attribute', 'type', 'classes', 'attributes', 'placeholder'];

            $givenHtmlParameters = explode(',', $string);

            $stringSections = $this->helper->htmlParametersAssigner($givenHtmlParameters, $validHtmlParameters);
            $stringSections['type'] = isset($stringSections['type']) ? $stringSections['type'] : $type;
            $stringSections['class'] = $this->helper->wrapperClass($stringSections, $frameworkClasses);

            $id = $this->autoId ? $this->attributes->autoId($stringSections) : $this->attributes->id($stringSections);
            $text = $this->attributes->text($stringSections) ?? $text;
            $name = $this->attributes->name($stringSections);
            $class = $this->attributes->class($stringSections);
            $attribute = $this->attributes->attribute($stringSections);
            $buttonType = isset($stringSections['type']) ? $this->attributes->type($stringSections) : $buttonType;
            $data = $this->helper->attributePlacer([$id, $buttonType, $class, $name, $attribute]);
        }

        return "
            <button $data>$text</button>
        ";
    }
}