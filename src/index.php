<?php

// Takes a word and a number, returns the word repeated that many times.
// If the number is 0, return "...". If it's more than 5, return only 5 repetitions
function repeat_word(string $word, int $repetitions)
{
    if ($repetitions <= 0) {
        return '...';
    }

    if ($repetitions > 5) {
        $repetitions = 5;
    }

    $output = '';

    for ($i = 0; $i < $repetitions; $i++) {
        $output .= $word;
    }

    return $output;
}

// Runs only if called from command line, but not on require
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    $fin = fopen('php://stdin', 'r');
    $line = trim(fgets($fin));

    // input is assumed to be: "word repetitions"
    $tokens = explode(' ', $line);
    $word = $tokens[0];
    $repetitions = (int) $tokens[1];

    $output = repeat_word($word, $repetitions);

    echo $output;
}
