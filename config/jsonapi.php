<?php

return [
    'resources' => [
        'trust-levels' => [
            'relationships' => [
                [
                    'type' => 'trust-level-translations',
                    'method' => 'trustLevelTranslations',
                    'model' => 'trust_level'
                ]
            ]
        ],
    ]
];
