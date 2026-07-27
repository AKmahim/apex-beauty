<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/content.php';
require_once __DIR__ . '/site-config.php';

// Knowledge base for the Apex AI widget. Two kinds of source:
//  - facts pulled live from the same CMS content / config the rest of the
//    site reads, so editing the FAQ or doctor bio in the admin panel keeps
//    the bot in sync automatically;
//  - a corpus extracted verbatim from hairpedia.php's own glossary/education
//    cards (data/apex-ai-corpus.json), so the bot's wording matches the site
//    instead of a second, possibly-inconsistent description of the same
//    facts.
// Every entry answer is EN/DE (the two languages with full site coverage);
// FR/NL/IT/TR visitors get the EN answer, same fallback convention as
// content-loader.js's applyBilingual().

function apex_ai_corpus(): array
{
    static $corpus = null;
    if ($corpus === null) {
        $path = APEX_DATA_DIR . '/apex-ai-corpus.json';
        $decoded = is_file($path) ? json_decode((string) file_get_contents($path), true) : null;
        $corpus = is_array($decoded) ? $decoded : ['cards' => [], 'glossary' => [], 'aftercareRules' => []];
    }
    return $corpus;
}

function apex_ai_knowledge_base(): array
{
    static $kb = null;
    if ($kb !== null) {
        return $kb;
    }
    $kb = [];
    $corpus = apex_ai_corpus();

    foreach ($corpus['glossary'] ?? [] as $i => $g) {
        $kb[] = [
            'id' => 'glossary-' . $i,
            'category' => 'education',
            'title' => ['en' => $g['term_en'], 'de' => $g['term_de']],
            'text' => ['en' => $g['def_en'], 'de' => $g['def_de']],
            'extraKeywords' => ['en' => [], 'de' => [], 'fr' => [], 'nl' => [], 'it' => [], 'tr' => []],
        ];
    }

    foreach ($corpus['cards'] ?? [] as $i => $c) {
        $kb[] = [
            'id' => 'card-' . $i,
            'category' => 'education',
            'title' => ['en' => $c['title_en'], 'de' => $c['title_de']],
            'text' => ['en' => $c['desc_en'], 'de' => $c['desc_de']],
            'extraKeywords' => ['en' => [], 'de' => [], 'fr' => [], 'nl' => [], 'it' => [], 'tr' => []],
        ];
    }

    if (!empty($corpus['aftercareRules'])) {
        $en = "Aftercare essentials after your transplant:\n";
        $de = "Die wichtigsten Verhaltensregeln nach Ihrer Transplantation:\n";
        foreach ($corpus['aftercareRules'] as $r) {
            $en .= '• ' . $r['en'] . "\n";
            $de .= '• ' . $r['de'] . "\n";
        }
        $kb[] = [
            'id' => 'aftercare-rules',
            'category' => 'recovery',
            'title' => ['en' => 'Aftercare rules', 'de' => 'Pflegehinweise nach der OP'],
            'text' => ['en' => trim($en), 'de' => trim($de)],
            'extraKeywords' => [
                'en' => ['aftercare', 'after care', 'post op', 'post-op', 'what should i avoid', 'sun', 'swimming', 'alcohol', 'smoking', 'sleep', 'washing hair'],
                'de' => ['nachsorge', 'pflege nach der op', 'was darf ich nicht', 'sonne', 'schwimmen', 'alkohol', 'rauchen', 'schlafen', 'haare waschen'],
                'fr' => ['soins post-operatoires'], 'nl' => ['nazorg'], 'it' => ['assistenza post-operatoria'], 'tr' => ['bakım'],
            ],
        ];
    }

    // --- FAQ, pulled live from the homepage CMS content ---
    // A small overlay of alternate phrasings for the handful of FAQ items
    // that get asked in noticeably different words than the question text
    // itself — keyed by the English question so it degrades gracefully
    // (just no bonus keywords) if the FAQ copy is ever reworded in the CMS,
    // rather than silently pointing at the wrong item.
    $faqSynonyms = [
        'How many grafts do I need?' => [
            'en' => ['how many hairs', 'hairs in one session', 'hairs can be transplanted', 'graft count'],
            'de' => ['wie viele haare', 'haare pro sitzung', 'anzahl der grafts'],
        ],
        'Does a hair transplant hurt?' => [
            'fr' => ['est-ce que ca fait mal', 'ca fait mal', 'douleur'],
            'nl' => ['doet het pijn', 'pijn'],
            'it' => ['fa male', 'dolore'],
            'tr' => ['aciyor mu', 'agri'],
        ],
    ];
    $home = apex_get_page_content('home');
    foreach (($home['faq']['items'] ?? []) as $i => $item) {
        $q = $item['question'] ?? [];
        $a = $item['answer'] ?? [];
        if (empty($q['en']) || empty($a['en'])) {
            continue;
        }
        $extra = $faqSynonyms[$q['en']] ?? [];
        $kb[] = [
            'id' => 'faq-' . $i,
            'category' => 'faq',
            'title' => ['en' => $q['en'], 'de' => $q['de'] ?? $q['en']],
            'text' => ['en' => $a['en'], 'de' => $a['de'] ?? $a['en']],
            'extraKeywords' => [
                'en' => $extra['en'] ?? [], 'de' => $extra['de'] ?? [],
                'fr' => $extra['fr'] ?? [], 'nl' => $extra['nl'] ?? [],
                'it' => $extra['it'] ?? [], 'tr' => $extra['tr'] ?? [],
            ],
        ];
    }

    // --- Doctor bio, pulled live ---
    $doctor = apex_get_page_content('doctor');
    $profile = $doctor['profiles']['items'][0] ?? null;
    if (is_array($profile)) {
        $bioEn = trim(strip_tags(($profile['intro']['en'] ?? '') . ' ' . ($profile['bio']['en'] ?? '')));
        $bioDe = trim(strip_tags(($profile['intro']['de'] ?? '') . ' ' . ($profile['bio']['de'] ?? '')));
        if ($bioEn !== '') {
            $kb[] = [
                'id' => 'doctor-bio',
                'category' => 'clinic',
                'title' => ['en' => 'Who is the doctor?', 'de' => 'Wer ist der Arzt?'],
                'text' => ['en' => $bioEn, 'de' => $bioDe !== '' ? $bioDe : $bioEn],
                'extraKeywords' => [
                    'en' => ['doctor', 'surgeon', 'who performs', 'physician', 'qualifications', 'experience'],
                    'de' => ['arzt', 'chirurg', 'wer operiert', 'qualifikation', 'erfahrung'],
                    'fr' => ['medecin', 'chirurgien'], 'nl' => ['arts', 'chirurg'], 'it' => ['medico', 'chirurgo'], 'tr' => ['doktor', 'cerrah'],
                ],
            ];
        }
    }

    $kb[] = [
        'id' => 'booking-consultation',
        'category' => 'clinic',
        'title' => ['en' => 'How do I book a consultation?', 'de' => 'Wie buche ich eine Beratung?'],
        'text' => [
            'en' => 'The first step is always a free consultation — either in person at our office in Linz, Austria, or remotely with photos. Message us on WhatsApp at ' . APEX_WHATSAPP_DISPLAY . ' or use the consultation form on this site, and our team will get back to you with a personalised assessment and treatment plan.',
            'de' => 'Der erste Schritt ist immer eine kostenlose Beratung — entweder persönlich in unserem Büro in Linz, Österreich, oder per Fernberatung mit Fotos. Schreiben Sie uns auf WhatsApp unter ' . APEX_WHATSAPP_DISPLAY . ' oder nutzen Sie das Beratungsformular auf dieser Seite, und unser Team meldet sich mit einer persönlichen Einschätzung und einem Behandlungsplan.',
        ],
        'extraKeywords' => [
            'en' => ['book', 'booking', 'consultation', 'appointment', 'get started', 'contact you', 'how to start', 'free consultation'],
            'de' => ['buchen', 'termin', 'beratung', 'kostenlose beratung', 'wie starte ich', 'kontakt aufnehmen'],
            'fr' => ['consultation gratuite', 'rendez-vous'], 'nl' => ['gratis consult', 'afspraak'],
            'it' => ['consulenza gratuita', 'appuntamento'], 'tr' => ['ücretsiz konsültasyon', 'randevu'],
        ],
    ];

    $kb[] = [
        'id' => 'clinic-location',
        'category' => 'clinic',
        'title' => ['en' => 'Where are you located?', 'de' => 'Wo befinden Sie sich?'],
        'text' => [
            'en' => APEX_BUSINESS_NAME . "'s European office is at " . APEX_ADDRESS_STREET . ', ' . APEX_ADDRESS_POSTAL_CODE . ' ' . APEX_ADDRESS_CITY . ', ' . APEX_ADDRESS_COUNTRY_NAME . '. Consultations happen here (or remotely); the procedure itself takes place at our partner clinic, with aftercare support across Europe.',
            'de' => APEX_BUSINESS_NAME . ' hat sein europäisches Büro in ' . APEX_ADDRESS_STREET . ', ' . APEX_ADDRESS_POSTAL_CODE . ' ' . APEX_ADDRESS_CITY . ', ' . APEX_ADDRESS_COUNTRY_NAME . '. Beratungen finden hier statt (oder per Fernberatung); der eigentliche Eingriff erfolgt in unserer Partnerklinik, mit Nachsorge in ganz Europa.',
        ],
        'extraKeywords' => [
            'en' => ['location', 'address', 'where are you', 'office', 'clinic address'],
            'de' => ['standort', 'adresse', 'wo befindet', 'büro', 'klinikadresse'],
            'fr' => ['adresse', 'ou etes-vous'], 'nl' => ['adres', 'waar bevindt'], 'it' => ['indirizzo', 'dove si trova'], 'tr' => ['adres', 'nerede'],
        ],
    ];

    // Deliberately doesn't invent a number — the site doesn't publish one.
    $kb[] = [
        'id' => 'cost-pricing',
        'category' => 'clinic',
        'title' => ['en' => 'How much does it cost?', 'de' => 'Was kostet es?'],
        'text' => [
            'en' => "Pricing depends on your graft count, technique, and the extent of the area treated, so we don't quote a number without a scalp analysis first. A free consultation gives you an exact, personalised quote with no obligation.",
            'de' => 'Der Preis hängt von der Graft-Anzahl, der Technik und dem Umfang des behandelten Bereichs ab, daher nennen wir keine Zahl ohne vorherige Kopfhautanalyse. Eine kostenlose Beratung liefert Ihnen ein genaues, persönliches Angebot ohne Verpflichtung.',
        ],
        'extraKeywords' => [
            'en' => ['cost', 'price', 'how much', 'pricing', 'expensive', 'cheap', 'payment plan', 'financing'],
            'de' => ['kosten', 'kostet', 'preis', 'kostenpunkt', 'wie viel', 'teuer', 'günstig', 'finanzierung', 'ratenzahlung'],
            'fr' => ['cout', 'prix', 'combien'], 'nl' => ['kosten', 'kost', 'prijs', 'hoeveel'], 'it' => ['costo', 'costa', 'prezzo', 'quanto'], 'tr' => ['maliyet', 'fiyat', 'ne kadar', 'tutar'],
        ],
    ];

    $kb[] = [
        'id' => 'what-is-hair-transplant',
        'category' => 'education',
        'title' => ['en' => 'What is a hair transplant?', 'de' => 'Was ist eine Haartransplantation?'],
        'text' => [
            'en' => "A hair transplant moves healthy, DHT-resistant follicles from a donor area (usually the back and sides of the scalp) into thinning or bald areas. At Apex Beauty this is done using FUE, Sapphire FUE, or DHI — follicles are extracted one by one and re-implanted by hand, so there's no linear scar, just tiny dot-like marks that fade within weeks.",
            'de' => 'Bei einer Haartransplantation werden gesunde, DHT-resistente Follikel aus einem Spenderbereich (meist Hinterkopf und Seiten) in lichte oder kahle Bereiche verpflanzt. Bei Apex Beauty geschieht dies mittels FUE, Saphir-FUE oder DHI — die Follikel werden einzeln entnommen und von Hand neu eingesetzt, sodass keine lineare Narbe entsteht, nur winzige, innerhalb weniger Wochen verblassende Punkte.',
        ],
        'extraKeywords' => [
            'en' => ['what is a hair transplant', 'how does a hair transplant work', 'hair transplant definition', 'what does it involve'],
            'de' => ['was ist eine haartransplantation', 'wie funktioniert eine haartransplantation'],
            'fr' => ['greffe de cheveux', 'transplantation capillaire'], 'nl' => ['haartransplantatie'],
            'it' => ['trapianto di capelli'], 'tr' => ['saç ekimi nedir'],
        ],
    ];

    $kb[] = [
        'id' => 'technique-comparison',
        'category' => 'education',
        'title' => ['en' => 'FUE vs Sapphire FUE vs DHI', 'de' => 'FUE vs. Saphir-FUE vs. DHI'],
        'text' => [
            'en' => "All three extract follicles individually, with no linear scar. FUE uses a standard steel micro-punch — the reliable, most affordable option. Sapphire FUE uses sapphire blades to open smaller, more precise channels, giving denser packing and slightly faster healing. DHI uses a Choi Implanter Pen to extract and implant in one motion, giving the most control over angle and direction, best suited to hairline and detail work, usually at a higher cost. Which is right for you depends on graft count and goals — exactly what the free consultation covers.",
            'de' => 'Alle drei Techniken entnehmen Follikel einzeln, ohne lineare Narbe. FUE nutzt einen klassischen Stahl-Mikro-Punch — die zuverlässige, günstigste Option. Saphir-FUE nutzt Saphirklingen für kleinere, präzisere Kanäle, was dichtere Packung und etwas schnellere Heilung ermöglicht. DHI nutzt einen Choi Implanter Pen, der in einem Schritt entnimmt und implantiert, und bietet die meiste Kontrolle über Winkel und Richtung — ideal für Haaransatz und Detailarbeit, meist zu höheren Kosten. Was für Sie passt, hängt von Graft-Anzahl und Zielen ab — genau das klärt die kostenlose Beratung.',
        ],
        'extraKeywords' => [
            'en' => ['fue vs dhi', 'difference between fue and dhi', 'which technique is best', 'compare techniques', 'fue vs saphir'],
            'de' => ['fue oder dhi', 'unterschied fue dhi', 'welche technik ist besser', 'techniken vergleichen'],
            'fr' => ['difference fue dhi'], 'nl' => ['verschil fue dhi'], 'it' => ['differenza fue dhi'], 'tr' => ['fue dhi farkı'],
        ],
    ];

    $kb[] = [
        'id' => 'candidacy',
        'category' => 'education',
        'title' => ['en' => 'Am I a good candidate?', 'de' => 'Bin ich geeignet?'],
        'text' => [
            'en' => "Good candidates typically have stable donor-area density (hair loss has settled rather than still rapidly progressing), realistic expectations about density and timeline, and no uncontrolled medical conditions that affect healing. Both men and women can be candidates, including for beard and eyebrow transplants. A free consultation with scalp analysis gives a precise, individual answer rather than a generic rule.",
            'de' => 'Gut geeignet sind in der Regel Personen mit stabiler Dichte im Spenderbereich (der Haarausfall hat sich stabilisiert, schreitet nicht mehr schnell fort), realistischen Erwartungen an Dichte und Zeitrahmen, und ohne unkontrollierte Erkrankungen, die die Heilung beeinträchtigen. Sowohl Männer als auch Frauen können geeignet sein, auch für Bart- und Augenbrauentransplantationen. Eine kostenlose Beratung mit Kopfhautanalyse liefert eine genaue, individuelle Antwort statt einer allgemeinen Regel.',
        ],
        'extraKeywords' => [
            'en' => ['am i a candidate', 'good candidate', 'can i get a transplant', 'suitable for transplant', 'too young', 'too old', 'not enough donor hair'],
            'de' => ['bin ich geeignet', 'kandidat für transplantation', 'kann ich eine transplantation bekommen', 'zu jung', 'zu alt'],
            'fr' => ['bon candidat'], 'nl' => ['goede kandidaat'], 'it' => ['buon candidato'], 'tr' => ['iyi bir aday mıyım'],
        ],
    ];

    $kb[] = [
        'id' => 'causes-overview',
        'category' => 'education',
        'title' => ['en' => 'What causes hair loss?', 'de' => 'Was verursacht Haarausfall?'],
        'text' => [
            'en' => 'Hair loss rarely has a single cause — genetics, DHT, hormonal changes, stress, nutrition, medications, and underlying medical conditions often act together. Genetics and DHT are the most common drivers of pattern baldness, but ask me about any one of these (for example "does stress cause hair loss") for more detail.',
            'de' => 'Haarausfall hat selten eine einzige Ursache — Genetik, DHT, hormonelle Veränderungen, Stress, Ernährung, Medikamente und zugrunde liegende Erkrankungen wirken oft zusammen. Genetik und DHT sind die häufigsten Treiber von erblich bedingtem Haarausfall, fragen Sie mich aber gerne nach jeder einzelnen Ursache (z. B. "verursacht Stress Haarausfall") für mehr Details.',
        ],
        'extraKeywords' => [
            'en' => ['causes of hair loss', 'why do i have hair loss', 'why am i losing hair', 'what causes baldness', 'reasons for hair loss'],
            'de' => ['ursachen von haarausfall', 'warum verliere ich haare', 'warum fallen mir die haare aus', 'gründe für haarausfall'],
            'fr' => ['causes de la chute de cheveux'], 'nl' => ['oorzaken van haaruitval'], 'it' => ['cause della caduta dei capelli'], 'tr' => ['saç dökülmesinin nedenleri'],
        ],
    ];

    $kb[] = [
        'id' => 'recovery-overview',
        'category' => 'recovery',
        'title' => ['en' => 'How long is recovery?', 'de' => 'Wie lange dauert die Genesung?'],
        'text' => [
            'en' => "Recovery happens in stages: scabs and redness settle within about 10 days, transplanted hair often sheds temporarily around weeks 2 to 4 (shock loss — the follicles survive), a quiet phase follows with little visible change, then fine new growth appears from month 3 to 4 and thickens through months 6 to 9. Full, final results are visible at 12 to 18 months, not immediately. Ask me about any single stage or the full aftercare rules for more detail.",
            'de' => 'Die Genesung verläuft in Phasen: Krusten und Rötung klingen innerhalb von etwa 10 Tagen ab, transplantiertes Haar fällt oft vorübergehend in Woche 2 bis 4 aus (Schock-Verlust, die Follikel überleben), es folgt eine ruhige Phase mit wenig sichtbarer Veränderung, dann erscheint feines neues Wachstum ab Monat 3 bis 4 und verdichtet sich bis Monat 6 bis 9. Das endgültige Ergebnis zeigt sich erst nach 12 bis 18 Monaten, nicht sofort. Fragen Sie mich gerne nach einer einzelnen Phase oder den vollständigen Pflegehinweisen für mehr Details.',
        ],
        'extraKeywords' => [
            'en' => ['how long is recovery', 'how long does recovery take', 'recovery time', 'healing time', 'when will i see results', 'recovery timeline', 'back to work', 'return to work', 'when can i work again', 'time off work'],
            'de' => ['wie lange dauert die genesung', 'wie lange dauert die heilung', 'genesungszeit', 'wann sehe ich ergebnisse', 'zeitlicher ablauf der genesung', 'wieder arbeiten', 'zurück zur arbeit', 'wie lange krankgeschrieben'],
            'fr' => ['duree de la recuperation'], 'nl' => ['hersteltijd', 'herstel'], 'it' => ['tempo di recupero'], 'tr' => ['iyileşme süresi'],
        ],
    ];

    $kb[] = [
        'id' => 'safety-risks',
        'category' => 'education',
        'title' => ['en' => 'Is it safe?', 'de' => 'Ist es sicher?'],
        'text' => [
            'en' => "Hair transplants using FUE, Sapphire FUE, or DHI are well-established, minimally invasive procedures performed under local anaesthesia. As with any procedure, there are risks: temporary shock loss, minor bleeding or swelling, infection if aftercare isn't followed, and — rarely — patchy or lower-than-expected growth. Choosing an experienced surgeon and following aftercare instructions are the biggest factors in avoiding complications.",
            'de' => 'Haartransplantationen mit FUE, Saphir-FUE oder DHI sind etablierte, minimal-invasive Eingriffe unter örtlicher Betäubung. Wie bei jedem Eingriff gibt es Risiken: vorübergehenden Schock-Verlust, leichte Blutungen oder Schwellungen, Infektionen bei mangelnder Nachsorge und — selten — fleckiges oder geringer als erwartetes Wachstum. Ein erfahrener Chirurg und die Einhaltung der Pflegehinweise sind die wichtigsten Faktoren, um Komplikationen zu vermeiden.',
        ],
        'extraKeywords' => [
            'en' => ['is it safe', 'safety', 'risks', 'side effects', 'dangerous', 'complications', 'is it risky', 'what could go wrong'],
            'de' => ['ist es sicher', 'sicherheit', 'risiken', 'nebenwirkungen', 'gefährlich', 'komplikationen', 'was kann schiefgehen'],
            'fr' => ['est-ce sans danger', 'risques'], 'nl' => ['is het veilig', 'risicos'], 'it' => ['e sicuro', 'rischi'], 'tr' => ['güvenli mi', 'riskler'],
        ],
    ];

    $kb[] = [
        'id' => 'why-choose-apex',
        'category' => 'clinic',
        'title' => ['en' => 'Why choose Apex Beauty?', 'de' => 'Warum Apex Beauty?'],
        'text' => [
            'en' => "Apex Beauty is built around continuous care rather than a one-off procedure: consultation and scalp analysis in Austria, the procedure at our partner clinic, and follow-up support across Europe, so you're never just handed off after surgery. Every plan starts from an individual scalp analysis, not a fixed package.",
            'de' => 'Apex Beauty setzt auf durchgehende Betreuung statt eines einmaligen Eingriffs: Beratung und Kopfhautanalyse in Österreich, der Eingriff in unserer Partnerklinik, und Nachsorge in ganz Europa, sodass Sie nach der OP nie allein gelassen werden. Jeder Plan basiert auf einer individuellen Kopfhautanalyse, nicht auf einem festen Paket.',
        ],
        'extraKeywords' => [
            'en' => ['why choose apex', 'why apex beauty', 'what makes you different', 'why should i pick you'],
            'de' => ['warum apex beauty', 'was macht euch anders', 'warum sollte ich euch wählen'],
            'fr' => ['pourquoi apex beauty'], 'nl' => ['waarom apex beauty'], 'it' => ['perché apex beauty'], 'tr' => ['neden apex beauty'],
        ],
    ];

    // Write the deduped result back into the static cache itself — not just
    // the return value — so every later call within the same request (this
    // function is called repeatedly, e.g. from apex_ai_document_frequencies())
    // gets the deduped list too, instead of only the very first caller.
    $kb = apex_ai_dedupe_by_title($kb);
    return $kb;
}

/**
 * The glossary and the education cards both describe some of the same
 * concepts (Finasteride, PRP, FUE, Anagen/Catagen/Telogen...) — one as a
 * one-line definition, one as a fuller card. Left as two entries, a match
 * on either one would suggest the other as a "related" topic, which reads
 * as the bot recommending the exact thing you just asked about. Keep only
 * the richer (longer) entry per title.
 */
function apex_ai_dedupe_by_title(array $kb): array
{
    $bestByTitle = [];
    foreach ($kb as $entry) {
        $key = mb_strtolower(trim($entry['title']['en'] ?? ''), 'UTF-8');
        if ($key === '') {
            continue;
        }
        $existing = $bestByTitle[$key] ?? null;
        if ($existing === null || mb_strlen($entry['text']['en'] ?? '') > mb_strlen($existing['text']['en'] ?? '')) {
            $bestByTitle[$key] = $entry;
        }
    }

    $seen = [];
    $result = [];
    foreach ($kb as $entry) {
        $key = mb_strtolower(trim($entry['title']['en'] ?? ''), 'UTF-8');
        if ($key === '' || isset($seen[$key])) {
            continue;
        }
        $seen[$key] = true;
        $result[] = $bestByTitle[$key];
    }
    return $result;
}
