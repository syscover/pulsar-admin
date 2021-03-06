<?php

return [

    //******************************************************************************************************************
    //***   Base lang, set main application language
    //******************************************************************************************************************
    'base_lang' => env('ADMIN_BASE_LANG', 'en'),

    //******************************************************************************************************************
    //***   Url to access to panel
    //******************************************************************************************************************
    'panel_url' => env('ADMIN_PANEL_URL', 'http://localhost:4200'),

    //******************************************************************************************************************
    //***   Route to call composer
    //******************************************************************************************************************
    'composer_bin' => env('ADMIN_COMPOSER_BIN', 'composer'),

    //******************************************************************************************************************
    //***   Resources that could contain custom fields
    //******************************************************************************************************************
    'field_group_resources' => [
        (object)['id' => 'cms-article-family',      'name' => 'Article families'],
        (object)['id' => 'market-product',          'name' => 'Products'],
        (object)['id' => 'hotels-hotel',            'name' => 'Hotels'],
        (object)['id' => 'spas-spa',                'name' => 'Spas'],
        (object)['id' => 'wineries-winery',         'name' => 'Wineries'],
    ],

    //******************************************************************************************************************
    //***   Resources that could contain attachments
    //******************************************************************************************************************
    'attachment_resources' => [
        (object)['id' => 'cms-article',             'name' => 'Articles'],
        (object)['id' => 'market-product',          'name' => 'Products'],
        (object)['id' => 'hotels-hotel',            'name' => 'Hotels'],
        (object)['id' => 'crm-customer',            'name' => 'Customers'],
        (object)['id' => 'spas-spa',                'name' => 'Spas'],
        (object)['id' => 'wine-wine',               'name' => 'Wines'],
        (object)['id' => 'wine-winery',             'name' => 'Wineries'],
        (object)['id' => 'forem-group',             'name' => 'Groups'],
        (object)['id' => 'innova-monument',         'name' => 'Monuments'],
        (object)['id' => 'innova-characteristic',   'name' => 'Characteristics'],
    ],

    //******************************************************************************************************************
    //***   Type fields to select on fields section
    //******************************************************************************************************************
    'field_types' => [
        (object)['id' => 'checkbox',            'name' => 'Checkbox',               'values' => false],
        (object)['id' => 'email',               'name' => 'Email',                  'values' => false],
        (object)['id' => 'model',               'name' => 'Model',                  'values' => false],
        (object)['id' => 'number',              'name' => 'Number',                 'values' => false],
        (object)['id' => 'select',              'name' => 'Select',                 'values' => true],
        (object)['id' => 'select-multiple',     'name' => 'Select multiple',        'values' => true],
        (object)['id' => 'text',                'name' => 'Text',                   'values' => false],
        (object)['id' => 'text-area',           'name' => 'Text Area',              'values' => false],
        (object)['id' => 'wysiwyg',             'name' => 'Wysiwyg',                'values' => false],
        (object)['id' => 'date',                'name' => 'Date',                   'values' => false],
        (object)['id' => 'datetime',            'name' => 'Datetime',               'values' => false],
        (object)['id' => 'header',              'name' => 'Header',                 'values' => false],
    ],

    //******************************************************************************************************************
    //***   Type data to select on fields section
    //******************************************************************************************************************
    'data_types' => [
        (object)['id' => 1,      'name' => 'String',            'type' => 'string'],
        (object)['id' => 2,      'name' => 'Boolean',           'type' => 'boolean'],
        (object)['id' => 3,      'name' => 'Integer',           'type' => 'integer'],
        (object)['id' => 4,      'name' => 'Float',             'type' => 'float'],
        (object)['id' => 5,      'name' => 'Array',             'type' => 'array'],
        (object)['id' => 6,      'name' => 'Object',            'type' => 'object'],
    ],

    //******************************************************************************************************************
    //***  Sizes to create images for various screen sizes
    //******************************************************************************************************************
    'sizes' => [
        (object)['id' => '25',      'name' => '-25%'],
        (object)['id' => '50',      'name' => '-50%'],
        (object)['id' => '75',      'name' => '-75%'],
    ],

    //******************************************************************************************************************
    //***  Frequencies to execute report
    //******************************************************************************************************************
    'frequencies' => [
        (object)['id' => 1, 'name' => 'admin::pulsar.once'],
        (object)['id' => 2, 'name' => 'admin::pulsar.daily'],
        (object)['id' => 3, 'name' => 'admin::pulsar.weekly'],
        (object)['id' => 4, 'name' => 'admin::pulsar.monthly'],
        (object)['id' => 5, 'name' => 'admin::pulsar.quarterly'],
        (object)['id' => 6, 'name' => 'admin::pulsar.yearly']
    ],

    //******************************************************************************************************************
    //***  Extensions files
    //******************************************************************************************************************
    'extensions' => [
        (object)['id' => 'csv',     'name' => '.csv'],
        (object)['id' => 'xls',     'name' => '.xls'],
        (object)['id' => 'xlsx',    'name' => '.xlsx']
    ],

    //******************************************************************************************************************
    //***  Fit types to adjust images
    //******************************************************************************************************************
    'fit_types' => [
        (object)['id' => 1, 'name' => 'admin::pulsar.fit_crop'],
        (object)['id' => 2, 'name' => 'admin::pulsar.width'],
        (object)['id' => 3, 'name' => 'admin::pulsar.height'],
        (object)['id' => 4, 'name' => 'admin::pulsar.width_free_crop'],
        (object)['id' => 5, 'name' => 'admin::pulsar.height_free_crop']
    ],

    //******************************************************************************************************************
    //***   Resources that could contain reports
    //******************************************************************************************************************
    'report_data_sources' => [
        (object)[
            'id'                => 1,    
            'name'              => 'admin::pulsar.countries',                 
            'translateable'     => true,        
            'type'              => 'database',   
            'model'             => 'Syscover\Admin\Models\Country',         
            'package'           => 1,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 2,    
            'name'              => 'admin::pulsar.profiles',                 
            'translateable'     => true,        
            'type'              => 'database',   
            'model'             => 'Syscover\Admin\Models\Profile',         
            'package'           => 1,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 3,    
            'name'              => 'forem::pulsar.unemployed_situations',
            'translateable'     => false,       
            'type'              => 'config',     
            'model'             => 'pulsar-forem.unemployed_situations',                                      
            'package'           => 500,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 4,    
            'name'              => 'forem::pulsar.expedient',
            'translateable'     => false,       
            'type'              => 'database',     
            'model'             => 'Syscover\Forem\Models\Expedient',                                      
            'package'           => 500,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 5,    
            'name'              => 'forem::pulsar.action',
            'translateable'     => false,       
            'type'              => 'database',     
            'model'             => 'Syscover\Forem\Models\Action',                                      
            'package'           => 500,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 6,    
            'name'              => 'forem::pulsar.group',
            'translateable'     => false,       
            'type'              => 'database',     
            'model'             => 'Syscover\Forem\Models\Group',                                      
            'package'           => 500,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 7,    
            'name'              => 'forem::pulsar.employment_office',
            'translateable'     => false,       
            'type'              => 'database',     
            'model'             => 'Syscover\Forem\Models\EmploymentOffice',                                      
            'package'           => 500,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 8,    
            'name'              => 'forem::pulsar.province',
            'translateable'     => false,       
            'type'              => 'database',     
            'model'             => 'Syscover\Forem\Models\Province',                                      
            'package'           => 500,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 9,    
            'name'              => 'forem::pulsar.availabilities',
            'translateable'     => false,       
            'type'              => 'config',     
            'model'             => 'pulsar-forem.availabilities',                                      
            'package'           => 500,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 10,    
            'name'              => 'forem::pulsar.academic_levels',
            'translateable'     => false,       
            'type'              => 'config',     
            'model'             => 'pulsar-forem.academic_levels',                                      
            'package'           => 500,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 11,    
            'name'              => 'forem::pulsar.teacher_profiles',
            'translateable'     => false,       
            'type'              => 'config',     
            'model'             => 'pulsar-forem.profiles',                                      
            'package'           => 500,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 12,    
            'name'              => 'forem::pulsar.category',
            'translateable'     => false,       
            'type'              => 'database',     
            'model'             => 'Syscover\Forem\Models\Category',                                      
            'package'           => 500,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
        (object)[
            'id'                => 13,    
            'name'              => 'market::pulsar.order_status',
            'translateable'     => true,       
            'type'              => 'database',     
            'model'             => 'Syscover\Market\Models\OrderStatus',                                      
            'package'           => 150,
            'option_id'         => 'id',
            'option_name'       => 'name'
        ],
    ],
];
