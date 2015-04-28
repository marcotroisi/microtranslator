<?php
/**
 * @author Marco Troisi
 * @created 15.04.15
 */

namespace MicroTranslator\Controller;

use MicroTranslator\Entity\Translation;
use MicroTranslator\Service\Translation as TranslationService;


class TranslationController extends ControllerBase
{
    /**
     * @var TranslationService
     */
    private $translationService;

    public function __construct(TranslationService $translationService)
    {

        $this->translationService = $translationService;
    }
    
    public function show($locale, $term = "")
    {
        if ($term != "") {
            $words = $this->translationService->show($locale, $term);
        } else {
            $words = $this->translationService->showAll();
        }

        $count = $this->translationService->count($locale, $term);

        $result = [
            'items' => [$words],
            'total' => $count
        ];

        echo json_encode($result);

        return true;
    }

    /**
     * @param $word
     * @param $locale
     * @param $term
     * @return $this
     */
    public function save($word, $locale, $term)
    {
        $translation = new Translation();
        $translation->translation = $term;
        $translation->word = $word;
        $translation->locale = $locale;

        $criteria = [
            'word' => $word,
            'locale' => $locale
        ];

        $result = $this->translationService->update($criteria, $translation, ['upsert' => true]);

        echo json_encode((bool) $result['ok']);

        return true;

    }
}
