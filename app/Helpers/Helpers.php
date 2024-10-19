<?php

if (!function_exists('formatDateTime')) {
    function formatDateTime($time)
    {
        return date('d/m/Y H:i', strtotime($time));
    }
}