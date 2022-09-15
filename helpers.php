<?php

$files = [
    'array',
];

foreach ($files as $file) {
    require_once(__DIR__ . '/helpers/' . $file . '.php');
}