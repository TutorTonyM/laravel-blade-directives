<?php

use TutorTonyM\BladeDirectives\DirectiveClasses\FormDirective;

return [
    'form' => function ($string){
        $form = new FormDirective();
        return $form->make($string);
    },
    'endform' => function (){
        return "</form>";
    }
];