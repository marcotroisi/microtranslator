<?php
/**
 * @author Marco Troisi
 * @created 04.04.15
 */

namespace MicroTranslator\Service;

use MicroTranslator\Repository\Translation as TranslationRepository;
use MicroTranslator\Entity\Translation as TranslationEntity;


class Translation {

    /**
     * @var TranslationRepository
     */
    private $translationRepository;

    public function __construct(TranslationRepository $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }

    public function save(TranslationEntity $entity)
    {
        $this->translationRepository->save($entity);
    }
}