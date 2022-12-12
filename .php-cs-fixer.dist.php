<?php

$finder = PhpCsFixer\Finder::create()
    ->in(array(
        'src',
        'tests',
    ));


$config = new PhpCsFixer\Config();
return $config->setRules([
    '@Symfony' => true,
    'no_unused_imports' => true,
    'no_superfluous_phpdoc_tags' => true,
    'final_class' => true
])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/.php_cs.cache');
