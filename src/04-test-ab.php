<?php

require_once __DIR__.'/../vendor/autoload.php';

use Exads\ABTestData;
use Oesteve\ABTest\App;
use Oesteve\ABTest\Simulator;

$samples = (int) ($argv[2] ?? 100);
$promotionId = (int) ($argv[1] ?? 1);

// We defined the ABTestData as a dependency to abstract the implementation
$abTest = new ABTestData($promotionId);

// We can simulate n visits to our site
$simulatorA = new Simulator($samples);
$simulatorA->simulate(function () use ($abTest) {
    // This simulation create a new instance of our app on every request
    // This will be the "natural" approach for web php apps
    return (new App($abTest))->getDesign();
});

// This Simulation keep the state between request
// this approach provide a bigger level of accuracy
$app = new App($abTest);

$simulatorB = new Simulator($samples);
$simulatorB->simulate(function () use ($app) {
    return $app->getDesign();
});

// Print the results
$simulatorA->print();
$simulatorB->print();
