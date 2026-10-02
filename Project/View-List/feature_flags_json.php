<?php
include_once __DIR__ . '/../../imports/feature_flags/feature_flags.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

echo json_encode([
    'donation'   => $BMJM_FEATURE_DONATION,
    'collection' => $BMJM_FEATURE_COLLECTION,
]);
