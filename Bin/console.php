<?php 

$options = getopt("a:b:", ["server:", "output:", "help"]);

if (isset($options['server'])) {
    switch ($options['server']) {
        case "start":
            exec('php -S 127.0.0.1:8000');
            break;
        default:
            break;
    }
}