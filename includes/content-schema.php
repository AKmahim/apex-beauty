<?php

declare(strict_types=1);

// Every page gets the same search-engine block. It is appended after the page
// list below rather than written out seven times, and always lands last so it
// never pushes the actual page copy down the section tabs.
$seoSection = static function (string $descriptionLabel): array {
    return [
        'label' => 'Search engine listing',
        'fields' => [
            ['key' => 'title', 'label' => 'Title shown in Google and the browser tab (about 60 characters)', 'type' => 'text'],
            ['key' => 'description', 'label' => $descriptionLabel, 'type' => 'richtext'],
            ['key' => 'shareImage', 'label' => 'Image shown when the page is shared on social media (1200 x 630 pixels works best)', 'type' => 'image'],
            ['key' => 'noindex', 'label' => 'Hide this page from Google', 'type' => 'toggle'],
        ],
    ];
};

$pages = [
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
        'label' => 'Doctors page',
        'sections' => [
            'profiles' => [
                'label' => 'Doctor profiles',
                'fields' => [],
                'list' => [
                    'key' => 'items',
                    'label' => 'Doctors',
                    'itemType' => 'fields',
                    'itemFields' => [
                        ['key' => 'photo', 'label' => 'Photo', 'type' => 'image'],
                        ['key' => 'name', 'label' => 'Name', 'type' => 'text'],
                        ['key' => 'credentials', 'label' => 'Title / credentials', 'type' => 'text'],
                        ['key' => 'intro', 'label' => 'Short intro line', 'type' => 'richtext'],
                        ['key' => 'bio', 'label' => 'Biography', 'type' => 'richtext'],
                        ['key' => 'specialtiesHeading', 'label' => 'Specialties heading (e.g. "Why Dr. Burhan")', 'type' => 'text'],
                        ['key' => 'specialty1Title', 'label' => 'Specialty 1 — title', 'type' => 'text'],
                        ['key' => 'specialty1Desc', 'label' => 'Specialty 1 — description', 'type' => 'text'],
                        ['key' => 'specialty2Title', 'label' => 'Specialty 2 — title', 'type' => 'text'],
                        ['key' => 'specialty2Desc', 'label' => 'Specialty 2 — description', 'type' => 'text'],
                        ['key' => 'specialty3Title', 'label' => 'Specialty 3 — title', 'type' => 'text'],
                        ['key' => 'specialty3Desc', 'label' => 'Specialty 3 — description', 'type' => 'text'],
                    ],
                ],
            ],
        ],
    ],
    // The package prices live here rather than in prices.php so the clinic can
    // change a price without a code change. prices.php renders every price
    // from these values (cards, comparison header, comparison footer) and the
    // Apex AI knowledge base reads the same file, so a price can only ever be
    // stated in one place. The feature lists and the comparison matrix stay in
    // the template: they change rarely and are structural rather than copy.
    'prices' => [
        'label' => 'Prices page',
        'sections' => [
            'hero' => ['label' => 'Hero', 'fields' => [
                ['key' => 'eyebrow', 'label' => 'Eyebrow chip', 'type' => 'text'],
                ['key' => 'heading', 'label' => 'Headline (wrap the highlighted part in <span>)', 'type' => 'richtext'],
                ['key' => 'sub', 'label' => 'Sub-headline', 'type' => 'richtext'],
            ]],
            'showcase' => ['label' => 'Package section heading', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'sub', 'label' => 'Sub-heading', 'type' => 'richtext'],
            ]],
            'packages' => [
                'label' => 'Packages',
                'fields' => [],
                'list' => [
                    'key' => 'items',
                    'label' => 'Packages (highest price first)',
                    'itemType' => 'fields',
                    'itemFields' => [
                        ['key' => 'name', 'label' => 'Package name', 'type' => 'text'],
                        ['key' => 'price', 'label' => 'Price (write it exactly as it should appear, per language)', 'type' => 'text'],
                        ['key' => 'priceNote', 'label' => 'Line under the price', 'type' => 'text'],
                        ['key' => 'badge', 'label' => 'Badge chip', 'type' => 'text'],
                        ['key' => 'description', 'label' => 'Short description', 'type' => 'richtext'],
                    ],
                ],
            ],
            'comparison' => ['label' => 'Comparison table heading', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'sub', 'label' => 'Sub-heading', 'type' => 'richtext'],
            ]],
            'notes' => [
                'label' => 'Notes under the table',
                'fields' => [],
                'list' => [
                    'key' => 'items',
                    'label' => 'Notes',
                    'itemType' => 'fields',
                    'itemFields' => [
                        ['key' => 'title', 'label' => 'Title', 'type' => 'text'],
                        ['key' => 'body', 'label' => 'Text', 'type' => 'richtext'],
                    ],
                ],
            ],
            'cta' => ['label' => 'Closing call to action', 'fields' => [
                ['key' => 'heading', 'label' => 'Heading', 'type' => 'text'],
                ['key' => 'sub', 'label' => 'Text', 'type' => 'richtext'],
            ]],
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

foreach ($pages as $pageKey => $page) {
    $pages[$pageKey]['sections']['seo'] = $seoSection(
        $pageKey === 'prices'
            ? 'Description shown under the title in Google (about 155 characters). Leave {range} in the text to keep the live price range in it.'
            : 'Description shown under the title in Google (about 155 characters)'
    );
}

return $pages;
