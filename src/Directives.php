<?php

use TutorTonyM\BladeDirectives\DirectiveClasses\FormDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\InputDirective;

return [
    'form' => function ($string){
        $form = new FormDirective();
        return $form->make($string);
    },
    'endform' => function (){
        return "</form>";
    },
    'input' => function($string){
        $input = new InputDirective();
        return $input->make($string);
    },
    'input_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true);
    },
    'number' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'number');
    },
    'number_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true, 'number');
    },
    'email' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'email');
    },
    'email_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true, 'email');
    },
    'hidden' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'hidden');
    },
    'hidden_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true, 'hidden');
    },
    'password' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'password');
    },
    'password_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true, 'password');
    }
];