<?php

return [
    'scriptName' => "Nirapod Blog",
    'owner' => 'Nirapod Soft',
    'minPHPVersion' => '8.0',
    'adminRouteName' => 'home',
    'activationURL' => 'https://nirapodhost.com/api/activation-check',
    'requirements' => [
        'php' => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
        ],
        'apache' => [
            'mod_rewrite',
        ],
    ],
    'permissions' => [
        'storage/framework/'     => '775',
        'storage/logs/'          => '775',
        'bootstrap/cache/'       => '775',
    ],

];