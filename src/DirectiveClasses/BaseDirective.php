<?php


namespace TutorTonyM\BladeDirectives\DirectiveClasses;

use Illuminate\Support\Str;
use TutorTonyM\BladeDirectives\Helpers\AttributesHelper;
use TutorTonyM\BladeDirectives\Helpers\ElementsHelper;
use TutorTonyM\BladeDirectives\Helpers\GeneralHelper;

class BaseDirective
{
    protected $helper;
    protected $attributes;
    protected $elements;
    protected $fullMode;

    public function __construct()
    {
        $this->helper = new GeneralHelper();
        $this->attributes = new AttributesHelper();
        $this->elements = new ElementsHelper();
        $this->fullMode = config('ttm-blade-directives.full');
    }
}