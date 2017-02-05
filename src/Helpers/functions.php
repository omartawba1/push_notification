<?php

if (!function_exists('array_get')) {
    /**
     * Get data from array
     *
     * @param array $ary
     * @param       $key
     * @param null  $default
     *
     * @return null
     */
    function array_get(array $ary, $key, $default = null)
    {
        return !empty($ary[$key]) ? $ary[$key] : $default;
    }
}

if (!function_exists('printHelp')) {
    /**
     * Print the help text
     *
     * @return string
     */
    function printHelp()
    {
        echo "usage: FIXME!\n";
    }
}
