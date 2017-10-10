<?php
$routes = [
    'metadata',
    'getInterpretation',
    'getAcademicEntities',
    'calcHistogram',
    'graphSearch',
    'calculateSimilarity'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

