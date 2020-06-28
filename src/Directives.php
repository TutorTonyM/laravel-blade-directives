<?php

use TutorTonyM\BladeDirectives\DirectiveClasses\ButtonDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\CheckboxOrRadioDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\FormDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\InputDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\LabelDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\SelectDirective;
use TutorTonyM\BladeDirectives\DirectiveClasses\TextareaDirective;

$this->form = new FormDirective();
$this->input = new InputDirective();
$this->button = new ButtonDirective();
$this->textarea = new TextareaDirective();
$this->checkboxOrRadio = new CheckboxOrRadioDirective();
$this->select = new SelectDirective();
$this->label = new LabelDirective();

return [
    'form' => function ($string){
        return $this->form->make($string);
    },
    'endform' => function (){
        return "</form>";
    },
    'input' => function($string){
        return $this->input->make($string);
    },
    'b4_input' => function($string){
        return $this->input->make($string, false, 'text', 'b4');
    },
    'input_req' => function($string){
        return $this->input->make($string, true);
    },
    'b4_input_req' => function($string){
        return $this->input->make($string, true, 'text', 'b4');
    },
    'number' => function($string){
        return $this->input->make($string, false, 'number');
    },
    'b4_number' => function($string){
        return $this->input->make($string, false, 'number', 'b4');
    },
    'number_req' => function($string){
        return $this->input->make($string, true, 'number');
    },
    'b4_number_req' => function($string){
        return $this->input->make($string, true, 'number', 'b4');
    },
    'email' => function($string){
        return $this->input->make($string, false, 'email');
    },
    'b4_email' => function($string){
        return $this->input->make($string, false, 'email', 'b4');
    },
    'email_req' => function($string){
        return $this->input->make($string, true, 'email');
    },
    'b4_email_req' => function($string){
        return $this->input->make($string, true, 'email', 'b4');
    },
    'password' => function($string){
        return $this->input->make($string, false, 'password');
    },
    'b4_password' => function($string){
        return $this->input->make($string, false, 'password', 'b4');
    },
    'b4_password_req' => function($string){
        return $this->input->make($string, true, 'password', 'b4');
    },
    'hidden' => function($string){
        return $this->input->make($string, false, 'hidden');
    },
    'button' => function($string){
        return $this->button->make($string);
    },
    'b4_button' => function($string){
        return $this->button->make($string, 'button', 'btn');
    },
    'b4_button_primary' => function($string){
        return $this->button->make($string, 'button', 'btn btn-primary');
    },
    'b4_button_secondary' => function($string){
        return $this->button->make($string, 'button', 'btn btn-secondary');
    },
    'b4_button_success' => function($string){
        return $this->button->make($string, 'button', 'btn btn-success');
    },
    'b4_button_danger' => function($string){
        return $this->button->make($string, 'button', 'btn btn-danger');
    },
    'b4_button_warning' => function($string){
        return $this->button->make($string, 'button', 'btn btn-warning');
    },
    'b4_button_info' => function($string){
        return $this->button->make($string, 'button', 'btn btn-info');
    },
    'b4_button_light' => function($string){
        return $this->button->make($string, 'button', 'btn btn-light');
    },
    'b4_button_dark' => function($string){
        return $this->button->make($string, 'button', 'btn btn-dark');
    },
    'b4_button_link' => function($string){
        return $this->button->make($string, 'button', 'btn btn-link');
    },
    'b4_button_outlinePrimary' => function($string){
        return $this->button->make($string, 'button', 'btn btn-outline-primary');
    },
    'b4_button_outlineSecondary' => function($string){
        return $this->button->make($string, 'button', 'btn btn-outline-secondary');
    },
    'b4_button_outlineSuccess' => function($string){
        return $this->button->make($string, 'button', 'btn btn-outline-success');
    },
    'b4_button_outlineDanger' => function($string){
        return $this->button->make($string, 'button', 'btn btn-outline-danger');
    },
    'b4_button_outlineWarning' => function($string){
        return $this->button->make($string, 'button', 'btn btn-outline-warning');
    },
    'b4_button_outlineInfo' => function($string){
        return $this->button->make($string, 'button', 'btn btn-outline-info');
    },
    'b4_button_outlineLight' => function($string){
        return $this->button->make($string, 'button', 'btn btn-outline-light');
    },
    'b4_button_outlineDark' => function($string){
        return $this->button->make($string, 'button', 'btn btn-outline-dark');
    },
    'submit' => function($string){
        return $this->button->make($string, 'submit');
    },
    'b4_submit' => function($string){
        return $this->button->make($string, 'submit', 'btn');
    },
    'b4_submit_primary' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-primary');
    },
    'b4_submit_secondary' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-secondary');
    },
    'b4_submit_success' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-success');
    },
    'b4_submit_danger' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-danger');
    },
    'b4_submit_warning' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-warning');
    },
    'b4_submit_info' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-info');
    },
    'b4_submit_light' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-light');
    },
    'b4_submit_dark' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-dark');
    },
    'b4_submit_link' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-link');
    },
    'b4_submit_outlinePrimary' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-outline-primary');
    },
    'b4_submit_outlineSecondary' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-outline-secondary');
    },
    'b4_submit_outlineSuccess' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-outline-success');
    },
    'b4_submit_outlineDanger' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-outline-danger');
    },
    'b4_submit_outlineWarning' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-outline-warning');
    },
    'b4_submit_outlineInfo' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-outline-info');
    },
    'b4_submit_outlineLight' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-outline-light');
    },
    'b4_submit_outlineDark' => function($string){
        return $this->button->make($string, 'submit', 'btn btn-outline-dark');
    },
    'textarea' => function($string){
        return $this->textarea->make($string);
    },
    'textarea_req' => function($string){
        return $this->textarea->make($string, true);
    },
    'b4_textarea' => function($string){
        return $this->textarea->make($string, false, 'b4');
    },
    'b4_textarea_req' => function($string){
        return $this->textarea->make($string, true, 'b4');
    },
    'checkbox' => function($string){
        return $this->checkboxOrRadio->make($string, false, 'checkbox');
    },
    'checkbox_req' => function($string){
        return $this->checkboxOrRadio->make($string, true, 'checkbox');
    },
    'b4_checkbox' => function($string){
        return $this->checkboxOrRadio->make($string, false, 'checkbox', 'b4');
    },
    'b4_checkbox_req' => function($string){
        return $this->checkboxOrRadio->make($string, true, 'checkbox', 'b4');
    },
    'radio' => function($string){
        return $this->checkboxOrRadio->make($string, false, 'radio');
    },
    'radio_req' => function($string){
        return $this->checkboxOrRadio->make($string, true, 'radio');
    },
    'b4_radio' => function($string){
        return $this->checkboxOrRadio->make($string, false, 'radio', 'b4');
    },
    'b4_radio_req' => function($string){
        return $this->checkboxOrRadio->make($string, true, 'radio', 'b4');
    },
    'select' => function($string){
        return $this->select->make($string);
    },
    'select_req' => function($string){
        return $this->select->make($string, true);
    },
    'b4_select' => function($string){
        return $this->select->make($string, false, 'b4');
    },
    'b4_select_req' => function($string){
        return $this->select->make($string, true, 'b4');
    },
    'label' => function($string){
        return $this->label->make($string);
    },
];