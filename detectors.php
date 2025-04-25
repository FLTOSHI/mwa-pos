<?php
return [
    'anomaly_detectors' => [
        [
            'name' => 'ДА-2',
            'bonus' => 3,
            'description' => '+3 к навыку "Аномалии"'
        ],
        [
            'name' => 'УДА-14а',
            'bonus' => 5,
            'description' => '+5 к навыку "Аномалии"'
        ]
    ],
    'artifact_detectors' => [
        [
            'name' => 'Отклик',
            'tiers' => [1],
            'description' => '1 тир артефактов'
        ],
        [
            'name' => 'Медведь',
            'tiers' => [1,2],
            'description' => '1-2 тиры артефактов'
        ],
        [
            'name' => 'Гилка',
            'tiers' => [1,2],
            'description' => '"Скажет", есть ли артефакты в аномалии'
        ],
        [
            'name' => 'Велес',
            'tiers' => [1,2,3],
            'description' => '1-3 тиры артефактов'
        ],
        [
            'name' => 'Сварог',
            'tiers' => [1,2,3],
            'description' => '1-3 тиры артефактов, УДА внутри'
        ]
    ]
];