<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Look & feel customizations
    |--------------------------------------------------------------------------
    |
    | Make it yours.
    |
    */

    // Public Site Name
    'site_name' => 'Mi Kapricho',

    // Menu logos
    'logo_lg'   => '<b>Lu</b>Na',
    'logo_mini' => '<b>L</b>N',

    // Developer or company name. Shown in footer.
    'developer_name' => 'Jonathan Freites',

    // Developer website. Link in footer.
    'developer_link' => 'http://luna.jonathanfreites.info',

    // Show powered by Luna in the footer?
    'show_powered_by' => true,

    // El nombre de la carpeta dentro de views donde estarán las plantillas con el diseño de tu sitio
    'templates_folder' => 'templates',

    // Options: skin-black, skin-blue, skin-purple, skin-red, skin-yellow, skin-green, skin-blue-light, skin-black-light, skin-purple-light, skin-green-light, skin-red-light, skin-yellow-light
    // Date & Datetime Format Syntax: https://github.com/jenssegers/date#usage
    // (same as Carbon)
    'default_date_format'     => 'j F Y',
    'default_datetime_format' => 'j F Y H:i',

    /*
    |--------------------------------------------------------------------------
    | Registration Open
    |--------------------------------------------------------------------------
    |
    | Choose wether new users are allowed to register.
    | This will show up the Register button in the menu and allow access to the
    | Register functions in AuthController.
    |
    */

    'registration_open' => false,

    /*
    |--------------------------------------------------------------------------
    | Cache system (use cache decorator in place of repository classes)
    |--------------------------------------------------------------------------
    */
    'cache' => true,

    /*
    |--------------------------------------------------------------------------
    | Save each front office page in public/html as flat html file.
    | Pages are generated only when debug is off and no user is connected.
    | The directory is cleaned on eloquent save, delete and composer install.
    |--------------------------------------------------------------------------
    */
    'html_cache' => false,

    /*
   |--------------------------------------------------------------------------
   | Max file upload size allowed
   |--------------------------------------------------------------------------
   */
    'max_file_upload_size' => 8000,

];
