<?php

use function PHPUnit\Framework\assertEquals;

require_once './src/index.php';

class RepeatWordTestConfig
{
    public static $LOOPS = 50;
}

test('<0 repetitions', function (): void {
    $MSG = "repeat_word(WORD, 0) was not '...'.";

    assertEquals('...', repeat_word('a', random_int(-1000, -1)), $MSG);
    assertEquals('...', repeat_word('abc', random_int(-1000, -1)), $MSG);
    assertEquals('...', repeat_word('234234234', random_int(-1000, -1)), $MSG);

    for ($i = 0; $i < RepeatWordTestConfig::$LOOPS; $i++) {
        $word = random_bytes(random_int(1, 50));
        assertEquals('...', repeat_word($word, random_int(-1000, -1)), $MSG);
    }
});

test('0 repetitions', function (): void {
    $MSG = "repeat_word(WORD, 0) was not '...'.";

    assertEquals('...', repeat_word('a', 0), $MSG);
    assertEquals('...', repeat_word('abc', 0), $MSG);
    assertEquals('...', repeat_word('234234234', 0), $MSG);

    for ($i = 0; $i < RepeatWordTestConfig::$LOOPS; $i++) {
        $word = random_bytes(random_int(1, 50));
        assertEquals('...', repeat_word($word, 0), $MSG);
    }
});

test('1 repetitions', function (): void {
    $MSG = 'repeat_word(WORD, 1) was different from WORD.';

    assertEquals('a', repeat_word('a', 1), $MSG);
    assertEquals('abc', repeat_word('abc', 1), $MSG);
    assertEquals('234234234', repeat_word('234234234', 1), $MSG);

    for ($i = 0; $i < RepeatWordTestConfig::$LOOPS; $i++) {
        $word = random_bytes(random_int(1, 50));
        assertEquals($word, repeat_word($word, 1), $MSG);
    }
});

test('valid N repetitions', function (): void {
    $MSG = 'repeat_word(WORD, 1-5) was different from WORD * (1-5).';

    $rep = random_int(1, 5);
    assertEquals(str_repeat('a', $rep), repeat_word('a', $rep), $MSG);
    assertEquals(str_repeat('abc', $rep), repeat_word('abc', $rep), $MSG);
    assertEquals(str_repeat('234234234', $rep), repeat_word('234234234', $rep), $MSG);

    for ($i = 0; $i < RepeatWordTestConfig::$LOOPS; $i++) {
        $rep = random_int(1, 5);
        $word = random_bytes(random_int(1, 50));
        assertEquals(str_repeat($word, $rep), repeat_word($word, $rep), $MSG);
    }
});

test('>5 repetitions', function (): void {
    $MSG = 'repeat_word(WORD, >5) was different from WORD * 5.';

    assertEquals('aaaaa', repeat_word('a', random_int(6, 1000)), $MSG);
    assertEquals('abcabcabcabcabc', repeat_word('abc', random_int(6, 1000)), $MSG);
    assertEquals('234234234234234234234234234234234234234234234', repeat_word('234234234', random_int(6, 1000)), $MSG);

    for ($i = 0; $i < RepeatWordTestConfig::$LOOPS; $i++) {
        $word = random_bytes(random_int(1, 50));
        assertEquals(str_repeat($word, 5), repeat_word($word, random_int(6, 1000)), $MSG);
    }
});
