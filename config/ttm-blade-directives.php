<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Package Mode
    |--------------------------------------------------------------------------
    |
    | This value enables or disables full mode.
    | Full mode takes a comma separated string with one
    | argument for each attribute in the element.
    | Light mode takes a non separated string and
    | displays the attributes verbatim.
    |
    */
    'full' => true,

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
    | Create the id Attribute Automatically
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
   | Validation Error Class for the Message
   |--------------------------------------------------------------------------
   |
   | This value is the class that will be added to the <spam> containing
   | the validation error message. It can be modified to match the expected
   | validation error class of different CSS frameworks such as Bootstrap.
   |
   */
    'validation_error_message_class' => 'error',
];