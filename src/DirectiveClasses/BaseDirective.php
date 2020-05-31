<?php


namespace TutorTonyM\BladeDirectives\DirectiveClasses;

use Illuminate\Support\Str;
use TutorTonyM\BladeDirectives\Helpers\AttributesHelper;
use TutorTonyM\BladeDirectives\Helpers\ElementsHelper;
use TutorTonyM\BladeDirectives\Helpers\GeneralHelper;
use TutorTonyM\BladeDirectives\Helpers\ValidationHelper;

class BaseDirective
{
    protected $helper;
    protected $attributes;
    protected $elements;
    protected $validation;
    protected $fullMode;
    protected $autoId;

    public function __construct()
    {
        $this->helper = new GeneralHelper();
        $this->attributes = new AttributesHelper();
        $this->elements = new ElementsHelper();
        $this->validation = new ValidationHelper();
        $this->fullMode = config('ttm-blade-directives.full');
        $this->autoId = config('ttm-blade-directives.auto_id');
    }
}