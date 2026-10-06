<?php
$policy_title = 'Terms & Conditions';
$policy_intro = 'These terms apply when you use the bmjm website, register for mosque membership, or make payments through the website.';
$policy_updated = 'September 11, 2026';
$policy_sections = [
    [
        'title' => 'Use Of The Website',
        'paragraphs' => [
            'By using this website, you agree to provide accurate information and to use the website only for lawful membership, subscription, donation, and mosque-service purposes.',
            'Bambalapitiya Jumma Masjid may update website features, payment options, account access rules, and these terms when required for operational, security, or compliance reasons.',
        ],
    ],
    [
        'title' => 'Membership Accounts',
        'paragraphs' => [
            'Members are responsible for keeping login credentials confidential and for notifying the mosque office if they believe account access has been compromised.',
            'Submitted membership information may be reviewed by authorized mosque administrators before approval or activation.',
        ],
    ],
    [
        'title' => 'Payments And Subscriptions',
        'paragraphs' => [
            'Payment amounts, subscription details, and eligible payment categories are shown before payment submission. Members should review the amount and purpose before confirming any transaction.',
            'All completed payments are subject to the Payment Policy and Refund Policy published on this website.',
        ],
    ],
    [
        'title' => 'Accuracy And Availability',
        'paragraphs' => [
            'bmjm aims to keep information accurate and available, but temporary interruptions, administrative updates, or technical issues may occur. The mosque office may verify payment and membership records where needed.',
        ],
    ],
    [
        'title' => 'Governing Law',
        'paragraphs' => [
            'These terms are governed by the applicable laws of Sri Lanka. Any concern should first be raised with Bambalapitiya Jumma Masjid so it can be reviewed and resolved in good faith.',
        ],
    ],
];

include_once './UxUI-Back/Needs/public-policy-layout.php';
