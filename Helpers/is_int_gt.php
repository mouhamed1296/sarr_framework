<?php

/**
 * is_int_gt
 *
 * @param int $var
 * @param int $comparer
 *
 * @return bool
 */
function is_int_gt(int $var, int $comparer): bool
{
    return is_int($var) && ($var > $comparer);
}
