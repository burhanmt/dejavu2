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
        'memory-levels' => [
            'relationships' => [
                [
                    'type'   => 'memory-level-translations', //route name
                    'method' => 'memoryLevelTranslations', //relationship method name
                    'model'  => 'memory_level' // modal name but snake case
                ]
            ]
        ],
        'goals' => [
            'relationships' => [
                [
                    'type'   => 'goal-translations', //route name
                    'method' => 'goalTranslations', //relationship method name
                    'model'  => 'goal' // modal name but snake case
                ]
            ]
        ],
        'interests' => [
            'relationships' => [
                [
                    'type'   => 'interest-translations', //route name
                    'method' => 'interestTranslations', //relationship method name
                    'model'  => 'interest' // modal name but snake case
                ]
            ]
        ],
        'dejavu-clients' => [
            'relationships' => [
                [
                    'type' => 'users', //route name
                    'method' => 'users', //relationship method name
                    'model' => 'dejavu_client' // modal name but snake case
                ]
            ]
        ],
    ]
];
