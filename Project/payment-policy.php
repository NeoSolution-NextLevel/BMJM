<?php
$policy_title = 'Payment Policy';
$policy_intro = 'This page explains how payments and member subscriptions are collected by Bambalapitiya Jumma Mosque through the bmjm website.';
$policy_updated = 'September 11, 2026';
$policy_sections = [
    [
        'title' => 'Payments We Accept',
        'paragraphs' => [
            'Bambalapitiya Jumma Mosque accepts eligible membership, subscription, donation, and service-related payments in Sri Lankan Rupees (LKR). Payments may be offered through the available online payment gateway, bank deposit, or approved offline payment methods shown to the member at the time of payment.',
        ],
        'items' => [
            'Member subscription payments are available after signing in to the member account.',
            'Online payments are processed through approved payment gateway providers.',
            'Bank deposit payments may require a valid payment slip or receipt upload for verification.',
        ],
    ],
    [
        'title' => 'Payment Confirmation',
        'paragraphs' => [
            'After a successful online payment, the system records the transaction and may show a receipt or confirmation message. Bank deposit and offline payments are confirmed after administrative review.',
            'If a payment status is not updated immediately, please keep the transaction reference and contact the mosque office for assistance.',
        ],
    ],
    [
        'title' => 'Security',
        'paragraphs' => [
            'bmjm does not store full card numbers, CVV values, or sensitive card authentication details on this website. Card and gateway credentials are handled by the payment gateway provider according to its own security controls.',
        ],
    ],
    [
        'title' => 'Contact For Payment Support',
        'paragraphs' => [
            'For payment questions, duplicate payment reports, failed payment checks, or receipt support, contact Bambalapitiya Jumma Mosque by email at Bambalapitiyajummamasjid@gmail.com or by phone at +94 70 344 578 12.',
        ],
    ],
];

include_once './UxUI-Back/Needs/public-policy-layout.php';
