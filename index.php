<?php
/**
 * @author Marco Troisi
 * @created 03.04.15
 */

require 'vendor/autoload.php';

$f3 = Base::instance();

/**
 * Mongo Connection
 */
$m = new MongoClient();
$db = $m->selectDB('microtranslator');

/**
 * Translation Service
 */
$translationService = new \MicroTranslator\Service\Translation(new \MicroTranslator\Repository\Translation($db));

/**
 * Controllers
 */
$localeController = new \MicroTranslator\Controller\LocaleController($translationService);
$translationController = new \MicroTranslator\Controller\TranslationController($translationService);

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
$f3->route('GET /locale',
    function() use ($localeController) {
        return $localeController->showAllAvailable();
    }
);

// Gets All Terms for a specific Locale
$f3->route('GET /translation/@locale',
    function($f3, $params) use ($translationController) {
        return $translationController->show($params['locale']);
    }
);

// Gets a Term for a specific Locale
$f3->route('GET /translation/@locale/@term',
    function($f3, $params) use ($translationController) {
        return $translationController->show($params['locale'], $params['term']);
    }
);

// Gets Untranslated Terms for a specific Locale

/**
 * Run F3 Application
 */
$f3->run();