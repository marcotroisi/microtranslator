<?php
/**
 * @author Marco Troisi
 * @created 03.04.15
 */

require 'vendor/autoload.php';

$f3 = Base::instance();

/**
 * Routes
 */

// Home
$f3->route('GET /',
    function() {
        echo 'Hello, world!';
    }
);

// Gets All Available Locales

// Gets All Terms for a specific Locale

// Counts All Terms for a specific Locale

// Gets a Term for a specific Locale

// Gets Untranslated Terms for a specific Locale

// Counts Untranslated Terms for a specific Locale

/**
 * Run F3 Application
 */
$f3->run();