<?php

/**
 * is_string_diff
 *
 * @param string $var
 * @param string $comparer
 *
 * @return bool
 */
function is_string_diff(string $var, string $comparer): bool
{
    return is_string($var) && ($var !== $comparer);
}
