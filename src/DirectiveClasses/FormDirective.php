<?php


namespace TutorTonyM\LaravelBladeDirectives\DirectiveClasses;


class FormDirective extends BaseDirective
{
    public function make($string)
    {
        $autoCsrf = config('ttm-blade-directives.csrf');

        $stringIsNotEmpty = $string == '' ? false : true;
        $method = 'method="POST"';
        $title = null;
        $csrf = $autoCsrf ? "<?php echo csrf_field(); ?>" : null;
        $spoof = null;
        $data = $method;

        if ($stringIsNotEmpty){
            $validHtmlParameters = ['action', 'title', 'class', 'id', 'attribute', 'method', 'csrf', 'classes', 'attributes'];
            $givenHtmlParameters = explode(',', $string);

            $stringSections = $this->helper->htmlParametersAssigner($givenHtmlParameters, $validHtmlParameters);

            $action = $this->attributes->action($stringSections);
            $title = $this->elements->title($stringSections);
            $class = $this->attributes->class($stringSections);
            $id = $this->attributes->id($stringSections);
            $attribute = $this->attributes->attribute($stringSections);
            $method = isset($stringSections['method']) ? $this->attributes->method($stringSections) : $method;
            $spoof = $this->elements->spoof($stringSections);
            $csrf = $this->elements->csrf($stringSections, $autoCsrf);

            $data = $this->helper->attributePlacer([$id, $class, $action, $method, $attribute]);
        }

        return "
            <form $data>
                $title
                $csrf
                $spoof
        ";
    }
}