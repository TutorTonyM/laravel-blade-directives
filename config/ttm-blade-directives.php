<?php

return [
    /*
    |--------------------------------------------------------------------------
    | CSRF Token
    |--------------------------------------------------------------------------
    |
    | This value enables or disables the auto feature for CSRF tokens.
    | When enabled (true), a CSRF token will be added to all forms.
    | When disabled (false), no CSRF token will be added.
    |
    */
    'csrf' => true,

    /*
    |--------------------------------------------------------------------------
    | Create the id Attribute Automatically (When no Value is Given)
    |--------------------------------------------------------------------------
    |
    | This value enables or disables the auto feature for the id attribute.
    | When enabled (true), if no id option is provided, it will use the name as the id.
    | When enabled (true), if an id option is provided, it will use that value as the id.
    | When disabled (false), if no id option is provided, it will not add an id attribute.
    | When disabled (false), if an id option is provided, it will use that value as the id.
    |
    | It does not apply to <form> tags.
    |
    */
    'auto_id' => true,

    /*
    |--------------------------------------------------------------------------
    | Labeling the Input Element (label, placeholder or both)
    |--------------------------------------------------------------------------
    |
    | This value sets the labeling preference for input element.
    |
    | placeholder = will use the label option in the placeholder attribute.
    | placeholder = will use the label option in the placeholder attribute.
    | label = will use the label option in a label element.
    | both = will do both the placeholder and label.
    | Note: Any value other than the ones above will result in no label at all.
    |
    | It does not apply to <form> tags.
    |
    */
    'labeling' => 'both',

    /*
    |--------------------------------------------------------------------------
    | Label the Input Automatically (When no Value is Given)
    |--------------------------------------------------------------------------
    |
    | This value enables or disables the auto feature for labeling inputs.
    | It will use the value of the name attribute. If no name value is provided
    | it will not do any labeling.
    |
    | It does not apply to <form> tags.
    |
    */
    'auto_label' => true,

    /*
   |--------------------------------------------------------------------------
   | Validation Error Class for the Message
   |--------------------------------------------------------------------------
   |
   | This value is the class that will be added to the <span> containing
   | the validation error message. It can be modified to match the expected
   | validation error class of different CSS frameworks such as Bootstrap.
   |
   */
    'validation_error_message_class' => 'error',
];