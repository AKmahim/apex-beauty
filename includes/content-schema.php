<?php

declare(strict_types=1);

return [
    'home' => [
        'label' => 'Homepage',
        'sections' => [
            'hero' => [
                'label' => 'Hero',
                'fields' => [
                    ['key' => 'eyebrow', 'label' => 'Eyebrow line', 'type' => 'text'],
                    ['key' => 'headline1', 'label' => 'Headline — line 1', 'type' => 'text'],
                    ['key' => 'headline2', 'label' => 'Headline — line 2', 'type' => 'text'],
                    ['key' => 'sub', 'label' => 'Subtext', 'type' => 'richtext'],
                    ['key' => 'ctaPrimary', 'label' => 'Primary button', 'type' => 'text'],
                    ['key' => 'ctaSecondary', 'label' => 'Secondary button', 'type' => 'text'],
                    ['key' => 'mobileVideo', 'label' => 'Hero video (mobile)', 'type' => 'video'],
                    ['key' => 'desktopVideo', 'label' => 'Hero video (desktop)', 'type' => 'video'],
                ],
                'list' => ['key' => 'trustPills', 'label' => 'Trust pills', 'itemType' => 'text'],
            ],
            'trustBar' => [
                'label' => 'Trust bar (stat strip)',
                'fields' => [
                    ['key' => 'stat1Label', 'label' => 'Stat 1 label (under patient count)', 'type' => 'text'],
                    ['key' => 'stat2Label', 'label' => 'Stat 2 label (under review score)', 'type' => 'text'],
                    ['key' => 'stat3Unit', 'label' => 'Stat 3 unit (e.g. "Years")', 'type' => 'text'],
                    ['key' => 'stat3Label', 'label' => 'Stat 3 label (under years)', 'type' => 'text'],
                    ['key' => 'stat4Main', 'label' => 'Stat 4 main text (e.g. "Largest Network")', 'type' => 'text'],
                    ['key' => 'stat4Label', 'label' => 'Stat 4 label', 'type' => 'text'],
                ],
            ],
            'promise' => [
                'label' => 'Promise / 360° care section',
                'fields' => [
                    ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                    ['key' => 'sub', 'label' => 'Subtext', 'type' => 'richtext'],
                    ['key' => 'video', 'label' => 'Background video', 'type' => 'video'],
                ],
            ],
            'beforeAfter' => [
                'label' => 'Before & after (Vorher/Nachher carousel)',
                'fields' => [
                    ['key' => 'heading1', 'label' => 'Heading (line 1)', 'type' => 'text'],
                    ['key' => 'heading2', 'label' => 'Heading (line 2, highlighted)', 'type' => 'text'],
                    ['key' => 'sub', 'label' => 'Subtext', 'type' => 'richtext'],
                ],
                'list' => [
                    'key' => 'cases', 'label' => 'Cases', 'itemType' => 'fields',
                    'itemFields' => [
                        ['key' => 'vorherImage', 'label' => 'Vorher photo', 'type' => 'image'],
                        ['key' => 'vorherLine1', 'label' => 'Vorher (line 1)', 'type' => 'text'],
                        ['key' => 'vorherLine2', 'label' => 'Vorher (line 2)', 'type' => 'text'],
                        ['key' => 'nachherImage', 'label' => 'Nachher photo', 'type' => 'image'],
                        ['key' => 'nachherLine1', 'label' => 'Nachher (line 1)', 'type' => 'text'],
                        ['key' => 'nachherLine2', 'label' => 'Nachher (line 2)', 'type' => 'text'],
                    ],
                ],
            ],
            'network' => [
                'label' => 'Aftercare network section',
                'fields' => [
                    ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                    ['key' => 'sub', 'label' => 'Subtext', 'type' => 'richtext'],
                ],
            ],
            'faq' => [
                'label' => 'FAQ',
                'fields' => [
                    ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ],
                'list' => [
                    'key' => 'items', 'label' => 'Questions', 'itemType' => 'fields',
                    'itemFields' => [
                        ['key' => 'question', 'label' => 'Question', 'type' => 'text'],
                        ['key' => 'answer', 'label' => 'Answer', 'type' => 'richtext'],
                    ],
                ],
            ],
        ],
    ],
    'hairpedia' => [
        'label' => 'Hairpedia',
        'sections' => [
            'hero' => ['label' => 'Hero', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'sub', 'label' => 'Subtext', 'type' => 'richtext'],
            ]],
            'wasIstHaarausfall' => ['label' => '1. Was ist Haarausfall?', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
                ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
            ]],
            'ursachen' => ['label' => '2. Ursachen', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
                ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
            ]],
            'arten' => ['label' => '3. Arten von Haarausfall', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
                ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
            ]],
            'diagnose' => ['label' => '4. Diagnose', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
                ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
            ]],
            'behandlung' => ['label' => '5. Behandlungsmöglichkeiten', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
                ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
            ]],
            'transplantation' => ['label' => '6. Haartransplantation', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
                ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
            ]],
            'genesung' => ['label' => '7. Genesung & Nachsorge', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
                ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
            ]],
            'vorherNachher' => ['label' => '8. Vorher-Nachher', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
                ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
            ]],
            'glossar' => ['label' => '9. Glossar', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
            ]],
        ],
    ],
    'service' => [
        'label' => 'Hair Transplant Service page',
        'sections' => [
            'hero' => ['label' => 'Hero', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'sub', 'label' => 'Subtext', 'type' => 'richtext'],
            ]],
            'umfasst' => ['label' => '1. Was die Behandlung umfasst', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
            ]],
            'geeignet' => ['label' => '2. Wer ist geeignet', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
            ]],
            'genesungService' => ['label' => '3. Genesung', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
            ]],
            'ergebnisse' => ['label' => '4. Ergebnisse', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
            ]],
        ],
    ],
    'doctor' => [
        'label' => 'Doctor page',
        'sections' => [
            'hero' => [
                'label' => 'Physician profile',
                'fields' => [
                    ['key' => 'photo', 'label' => 'Photo', 'type' => 'image'],
                    ['key' => 'name', 'label' => 'Name', 'type' => 'text'],
                    ['key' => 'credentials', 'label' => 'Title / credentials', 'type' => 'text'],
                    ['key' => 'intro', 'label' => 'Short intro line', 'type' => 'richtext'],
                    ['key' => 'bio', 'label' => 'Biography', 'type' => 'richtext'],
                ],
            ],
            'specialties' => [
                'label' => 'Specialties / focus areas',
                'fields' => [
                    ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ],
            ],
        ],
    ],
    'contact' => [
        'label' => 'Contact / consultation modal',
        'sections' => [
            'intro' => ['label' => 'Modal intro', 'fields' => [
                ['key' => 'title', 'label' => 'Title', 'type' => 'text'],
                ['key' => 'sub', 'label' => 'Subtext', 'type' => 'richtext'],
            ]],
        ],
    ],
    'privacy' => [
        'label' => 'Privacy policy',
        'sections' => [
            'intro' => ['label' => 'Page intro', 'fields' => [
                ['key' => 'title', 'label' => 'Title', 'type' => 'text'],
                ['key' => 'sub', 'label' => 'Subtext', 'type' => 'richtext'],
            ]],
            'sections' => [
                'label' => 'Legal sections',
                'fields' => [],
                'list' => [
                    'key' => 'items',
                    'label' => 'Sections',
                    'itemType' => 'fields',
                    'itemFields' => [
                        ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                        ['key' => 'body', 'label' => 'Body text', 'type' => 'richtext'],
                    ],
                ],
            ],
        ],
    ],
];
