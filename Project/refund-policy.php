<?php
$policy_title = 'Refund Policy';
$policy_intro = 'This refund policy explains how duplicate, mistaken, or failed payments are reviewed for bmjm website transactions.';
$policy_updated = 'September 11, 2026';
$policy_sections = [
    [
        'title' => 'Refund Eligibility',
        'paragraphs' => [
            'Refund requests are reviewed case by case. A refund may be considered when a duplicate payment, wrong amount, technical payment error, or clearly mistaken payment can be verified from bmjm and payment gateway records.',
        ],
        'items' => [
            'Duplicate online payments for the same purpose may be refunded after verification.',
            'Failed transactions that are later debited from the payer account may be checked with the gateway provider.',
            'Donations or payments already allocated to mosque activities may not be refundable unless required by law or approved by mosque administration.',
        ],
    ],
    [
        'title' => 'How To Request A Refund',
        'paragraphs' => [
            'To request a refund, contact Bambalapitiya Jumma Mosque within 7 days of the payment date. Include the payer name, phone number, payment date, amount, payment purpose, and transaction reference or receipt.',
        ],
    ],
    [
        'title' => 'Processing Time',
        'paragraphs' => [
            'Approved refunds are processed through the original payment method where possible. Processing time may depend on the payment gateway, bank, or card issuer.',
            'bmjm may contact the payer for additional information before approving or rejecting a refund request.',
        ],
    ],
    [
        'title' => 'Contact',
        'paragraphs' => [
            'Refund requests and payment concerns can be sent to Bambalapitiyajummamasjid@gmail.com or raised by phone at +94 70 344 578 12.',
        ],
    ],
];

include_once './UxUI-Back/Needs/public-policy-layout.php';
