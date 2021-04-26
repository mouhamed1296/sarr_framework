<?php

/**
 * is_int_lt_or_eq
 *
 * @param int $var
 * @param int $comparer
 *
 * @return bool
 */
function is_int_lt_or_eq(int $var, int $comparer): bool
{
    return is_int($var) && ($var <= $comparer);
}
