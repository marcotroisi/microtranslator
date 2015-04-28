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

$locale = (isset($_GET['locale'])) ? $_GET['locale'] : 'en_GB';
$mongoDictionary = new \MicroTranslator\Library\MongoDictionary($locale, $db, 'translations', 'word', 'translation');
$translator = new \Moss\Locale\Translator\Translator($locale, $mongoDictionary);

/**
 * Translation Service
 */
$translationService = new \MicroTranslator\Service\Translation(
    new \MicroTranslator\Repository\Translation($db),
    $translator
);

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
        echo 'MicroTranslator';
    }
);

// Gets All Available Locales
$f3->route('GET /locale',
    function() use ($localeController) {
        return $localeController->showAllAvailable();
    }
);

// Gets All Terms for a specific Locale
$f3->route('GET /translation',
    function($f3, $params) use ($translationController, $locale) {
        return $translationController->show($locale);
    }
);

// Gets a Term for a specific Locale
$f3->route('GET /translation/@term',
    function($f3, $params) use ($translationController, $locale) {
        return $translationController->show($locale, $params['term']);
    }
);

// Gets Untranslated Terms for a specific Locale

// Save a Term for a Locale
$f3->route('POST /translation/@word',
    function($f3, $params) use ($translationController, $locale) {

        $translation = $f3->get('POST.translation');
        $word = $params['word'];

        return $translationController->save($word, $locale, $translation);
    }
);

/**
 * Run F3 Application
 */
$f3->run();
