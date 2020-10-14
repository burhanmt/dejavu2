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
        'part-of-speeches' => [
            'relationships' => [
                [
                    'type'   => 'part-of-speech-translations',
                    'method' => 'partOfSpeechTranslations',
                    'model'  => 'part_of_speech'
                ]
            ]
        ],
    ]
];
