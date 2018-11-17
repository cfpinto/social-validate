<?php

require_once realpath(__DIR__ . '/../vendor/autoload.php');
require_once realpath(__DIR__ . '/../src/Validators/ValidatorInterface.php');
require_once realpath(__DIR__ . '/../src/Validators/AbstractValidator.php');
require_once realpath(__DIR__ . '/../src/Validators/Youtube.php');
require_once realpath(__DIR__ . '/../src/Validator.php');

$config = require_once realpath(__DIR__ . '/../src/config/social-validate.php');
$validator = new \SocialValidate\Validator($config);
$youtube = $validator->driver('facebook');
$url = isset($argv[1]) ? $argv[1] : 'https://www.youtube.com/watch?v=123456789';

echo $url . ' => ' . $validator->guess($url) . PHP_EOL;
echo json_encode($youtube->isValid($url)) . PHP_EOL;
