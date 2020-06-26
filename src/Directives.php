<?php

use TutorTonyM\BladeDirectives\DirectiveClasses\ButtonDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\CheckboxDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\FormDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\InputDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\TextareaDirective;

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
    },
    'button' => function($string){
        $button = new ButtonDirective();
        return $button->make($string);
    },
    'b4_button' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn');
    },
    'b4_button_primary' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-primary');
    },
    'b4_button_secondary' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-secondary');
    },
    'b4_button_success' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-success');
    },
    'b4_button_danger' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-danger');
    },
    'b4_button_warning' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-warning');
    },
    'b4_button_info' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-info');
    },
    'b4_button_light' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-light');
    },
    'b4_button_dark' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-dark');
    },
    'b4_button_link' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-link');
    },
    'b4_button_outlinePrimary' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-outline-primary');
    },
    'b4_button_outlineSecondary' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-outline-secondary');
    },
    'b4_button_outlineSuccess' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-outline-success');
    },
    'b4_button_outlineDanger' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-outline-danger');
    },
    'b4_button_outlineWarning' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-outline-warning');
    },
    'b4_button_outlineInfo' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-outline-info');
    },
    'b4_button_outlineLight' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-outline-light');
    },
    'b4_button_outlineDark' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'button', 'btn btn-outline-dark');
    },
    'submit' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit');
    },
    'b4_submit' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn');
    },
    'b4_submit_primary' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-primary');
    },
    'b4_submit_secondary' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-secondary');
    },
    'b4_submit_success' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-success');
    },
    'b4_submit_danger' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-danger');
    },
    'b4_submit_warning' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-warning');
    },
    'b4_submit_info' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-info');
    },
    'b4_submit_light' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-light');
    },
    'b4_submit_dark' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-dark');
    },
    'b4_submit_link' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-link');
    },
    'b4_submit_outlinePrimary' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-outline-primary');
    },
    'b4_submit_outlineSecondary' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-outline-secondary');
    },
    'b4_submit_outlineSuccess' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-outline-success');
    },
    'b4_submit_outlineDanger' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-outline-danger');
    },
    'b4_submit_outlineWarning' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-outline-warning');
    },
    'b4_submit_outlineInfo' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-outline-info');
    },
    'b4_submit_outlineLight' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-outline-light');
    },
    'b4_submit_outlineDark' => function($string){
        $button = new ButtonDirective();
        return $button->make($string, 'submit', 'btn btn-outline-dark');
    },
    'textarea' => function($string){
        $button = new TextareaDirective();
        return $button->make($string);
    },
    'textarea_req' => function($string){
        $button = new TextareaDirective();
        return $button->make($string, true);
    },
    'b4_textarea' => function($string){
        $button = new TextareaDirective();
        return $button->make($string, false, 'b4');
    },
    'b4_textarea_req' => function($string){
        $button = new TextareaDirective();
        return $button->make($string, true, 'b4');
    },
    'checkbox' => function($string){
        $button = new CheckboxDirective();
        return $button->make($string);
    },
    'checkbox_req' => function($string){
        $button = new CheckboxDirective();
        return $button->make($string, true);
    },
    'b4_checkbox' => function($string){
        $button = new CheckboxDirective();
        return $button->make($string, false, 'b4');
    },
];