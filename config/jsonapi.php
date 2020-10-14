<?php

return [
    'resources' => [
        'trust-levels' => [
            'relationships' => [
                [
                    'type' => 'trust-level-translations', //route name
                    'method' => 'trustLevelTranslations', //relationship method name
                    'model' => 'trust_level' // modal name but snake case
                ]
            ]
        ],
        'part-of-speeches' => [
            'relationships' => [
                [
                    'type'   => 'part-of-speech-translations', //route name
                    'method' => 'partOfSpeechTranslations', //relationship method name
                    'model'  => 'part_of_speech' // modal name but snake case
                ]
            ]
        ],
    ]
];
