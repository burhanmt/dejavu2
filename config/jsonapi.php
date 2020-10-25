<?php

return [
    'resources' => [
        'trust-levels' => [
            'relationships' => [
                [
                    'type' => 'trust-level-translations', //route name
                    'method' => 'trustLevelTranslations', //relationship method name
                    'model' => 'trust_level' // model name but snake case
                ]
            ]
        ],
        'part-of-speeches' => [
            'relationships' => [
                [
                    'type'   => 'part-of-speech-translations', //route name
                    'method' => 'partOfSpeechTranslations', //relationship method name
                    'model'  => 'part_of_speech' // model name but snake case
                ]
            ]
        ],
        'memory-levels' => [
            'relationships' => [
                [
                    'type'   => 'memory-level-translations', //route name
                    'method' => 'memoryLevelTranslations', //relationship method name
                    'model'  => 'memory_level' // model name but snake case
                ]
            ]
        ],
        'goals' => [
            'relationships' => [
                [
                    'type'   => 'goal-translations', //route name
                    'method' => 'goalTranslations', //relationship method name
                    'model'  => 'goal' // model name but snake case
                ]
            ]
        ],
        'interests' => [
            'relationships' => [
                [
                    'type'   => 'interest-translations', //route name
                    'method' => 'interestTranslations', //relationship method name
                    'model'  => 'interest' // model name but snake case
                ]
            ]
        ],
        'dejavu-clients' => [
            'relationships' => [
                [
                    'type' => 'users', //route name
                    'method' => 'users', //relationship method name
                    'model' => 'dejavu_client' // model name but snake case
                ]
            ]
        ],
        'users' => [
            'relationships' => [
                [
                    'type' => 'dejavu-clients', //route name
                    'method' => 'dejavuClients', //relationship method name
                    'model' => 'user' // model name but snake case
                ]
            ]
        ],
        'user-profiles' => [
            'relationships' => [
                [
                    'type' => 'users', //route name
                    'method' => 'user', //relationship method name
                    'model' => 'user_profile' // model name but snake case
                ]
            ]
        ],
    ]
];
