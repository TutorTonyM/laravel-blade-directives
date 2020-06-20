<?php


namespace TutorTonyM\LaravelBladeDirectives\DirectiveClasses;

use Illuminate\Support\Str;
use TutorTonyM\LaravelBladeDirectives\Helpers\AttributesHelper;
use TutorTonyM\LaravelBladeDirectives\Helpers\ElementsHelper;
use TutorTonyM\LaravelBladeDirectives\Helpers\GeneralHelper;
use TutorTonyM\LaravelBladeDirectives\Helpers\ValidationHelper;

class BaseDirective
{
    protected $helper;
    protected $attributes;
    protected $elements;
    protected $validation;
    protected $fullMode;
    protected $autoId;
    protected $labeling;
    protected $autoLabel;

    public function __construct()
    {
        $this->helper = new GeneralHelper();
        $this->attributes = new AttributesHelper();
        $this->elements = new ElementsHelper();
        $this->validation = new ValidationHelper();
        $this->fullMode = config('ttm-blade-directives.full');
        $this->autoId = config('ttm-blade-directives.auto_id');
        $this->labeling = config('ttm-blade-directives.labeling');
        $this->autoLabel = config('ttm-blade-directives.auto_label');
    }
}