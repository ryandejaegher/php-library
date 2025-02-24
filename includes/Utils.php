<?php

namespace Ryandejeagher\PhpLibrary;

class Utils
{
    /**
     * Ensures that the code is running within a WordPress environment.
     *
     * @return void
     */
    public static function verifyWordPress()
    {
        if (! defined('ABSPATH')) {
            exit;
        }
    }

    /**
     * Determines the environment based on the HTTP_HOST or SERVER_NAME.
     *
     * @return string 'prod', 'stage', 'dev', or 'local'
     */
    public static function getEnvironment(): string
    {
        $host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? '';

        $patterns = [
            'prod' => '/^(www|www3|sthm\d*)\./', // Matches www, www3, sthm, sthm2
            'stage' => '/\b(?:[\w-]*?(stage|staging)\d*)\./',  // Matches stage, stage2, staging, staging2, sthm-stage2
            'dev' => '/\b(?:[\w-]*?dev\d*)\./',    // Matches dev, dev2, sthm-dev2
        ];

        foreach ($patterns as $env => $pattern) {
            if (preg_match($pattern, $host)) {
                return $env;
            }
        }

        return 'local';
    }
}
