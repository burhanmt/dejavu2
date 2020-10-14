<?php

return [
    'resources' => [
        'trust-levels' => [
            'relationships' => [
                [
                    'type' => 'trust-level-translations',
                    'method' => 'trustLevelTranslations',
                    'model' => 'trust_level' // modal name but snake case
                ]
            ]
        ],
        'part-of-speeches' => [
            'relationships' => [
                [
                    'type'   => 'part-of-speech-translations',
                    'method' => 'partOfSpeechTranslations',
                    'model'  => 'part_of_speech' // modal name but snake case
                ]
            ]
        ],
    ]
];
