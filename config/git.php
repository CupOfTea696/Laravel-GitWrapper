<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Add Laravel's default logger to the GitWrapper instance. You may
    | also specify a channel to use, or a channel stack.
    |
    */
    
    'logger' => false,
    
    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */
    
    'default' => 'main',
    
    /*
    |--------------------------------------------------------------------------
    | Git Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many
    | connections as you would like. Note that the 2 supported
    | authentication methods are: "ssh_key", and "none".
    |
    */
    
    'connections' => [
        'main' => [
            'auth' => 'none',
        ],
        
        'ssh' => [
            'auth' => 'ssh_key',
            'key_path' => storage_path('app/ssh/id_rsa'),
            // 'port' => 22,
        ],
    ],
];
