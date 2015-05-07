<?php
/**
 * @author Marco Troisi
 * @created 04.04.15
 */

namespace MicroTranslator\Test;


use MicroTranslator\Service\Translation;

class TranslationServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Translation
     */
    private $translationService;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $translationRepository;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $translator;

    protected function setUp()
    {
        parent::setUp();

        $this->translationRepository = $this->getMockBuilder('\MicroTranslator\Repository\Translation')->disableOriginalConstructor()->getMock();
        $this->translator = $this->getMockBuilder('\Moss\Locale\Translator\Translator')->disableOriginalConstructor()->getMock();

        $this->translationService = new Translation($this->translationRepository, $this->translator);
    }


    public function testSave()
    {
        $translationEntity = $this->getMock('\MicroTranslator\Entity\Translation');

        $this->translationRepository->expects($this->once())->method('save')->with($translationEntity);

        $this->translationService->save($translationEntity);
    }
}
