<?php
/**
 * @author Marco Troisi
 * @created 10.04.15
 */

namespace MicroTranslator\Controller;

use MicroTranslator\Service\Translation as TranslationService;


class LocaleController extends ControllerBase
{
    /**
     * @var TranslationService
     */
    private $translationService;

    public function __construct(TranslationService $translationService)
    {

        $this->translationService = $translationService;
    }
    
    public function showAllAvailable()
    {
        $locales = $this->translationService->getAvailableLocales();

        $count = count($locales);

        $result = [
            'items' => $locales,
            'count' => $count
        ];

        echo json_encode($result);

        return true;
    }
}
