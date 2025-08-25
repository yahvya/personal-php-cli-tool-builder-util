<?php

$subject = implode(" ", $argv);

die($argv);

$regex = "~\s(--[a-zA-Z0-9_-]+)([\s=]+((?:(?!\s--).)*))?~";

preg_match_all($regex, $subject, $matches);

$optionsMap = [];

foreach ($matches[1] as $key => $value)
{
    $optionsMap[$value] = substr($matches[2][$key], 1);
}

var_dump($optionsMap);