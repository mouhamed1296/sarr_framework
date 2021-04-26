<?php

/**
 * is_int_lt
 *
 * @param int $var
 * @param int $comparer
 *
 * @return bool
 */
function is_int_lt(int $var, int $comparer): bool
{
    return is_int($var) && ($var < $comparer);
}
