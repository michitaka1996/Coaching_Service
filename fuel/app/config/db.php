<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
     'active' => 'mysqli',
    // 'pdo' => array(
    //     'type'           => 'pdo',
    //     'connection'     => array(
    //         'dsn'        => 'mysql:host=localhost;dbname=Athle',
    //         'username'       => 'root',
    //         'password'       => 'root',
    //         'persistent'     => false,
    //         'compress'       => false,
    //     ),
    //     'table_prefix' => '',
    //     'charset'      => 'utf8',
    //     'caching'      => false,
    //     'profiling'    => true,
    // ),
    'mysqli' => array(
        'type'           => 'mysqli',
        'connection'     => array(
            'hostname' => 'localhost',
            'database' => 'Athle',
            'username'       => 'root',
            'password'       => 'root',
            'persistent'     => false,
            'compress'       => false,
        ),
        'identifier' => '`',
        'table_prefix' => '',
        'charset'      => 'utf8',
        'caching'      => false,
        'profiling'    => true,
    ),

);
