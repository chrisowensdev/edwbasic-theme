<?php

function edw_mod(string $key, $default = '')
{
    return get_theme_mod('edw_' . $key, $default);
}
