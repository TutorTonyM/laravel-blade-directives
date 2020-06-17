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
    'b4_input' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'text', 'b4');
    },
    'input_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true);
    },
    'b4_input_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true, 'text', 'b4');
    },
    'number' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'number');
    },
    'b4_number' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'number', 'b4');
    },
    'number_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true, 'number');
    },
    'b4_number_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true, 'number', 'b4');
    },
    'email' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'email');
    },
    'b4_email' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'email', 'b4');
    },
    'email_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true, 'email');
    },
    'b4_email_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true, 'email', 'b4');
    },
    'password' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'password');
    },
    'b4_password' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'password', 'b4');
    },
    'b4_password_req' => function($string){
        $input = new InputDirective();
        return $input->make($string, true, 'password', 'b4');
    },
    'hidden' => function($string){
        $input = new InputDirective();
        return $input->make($string, false, 'hidden');
    }
];