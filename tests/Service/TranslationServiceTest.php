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

    public function testUpdate()
    {
        $translationEntity = $this->getMock('\MicroTranslator\Entity\Translation');

        $criteria = ['_id' => 1];
        $options = ['upsert' => true];

        $this->translationRepository->expects($this->once())->method('update')->with($criteria, $translationEntity, $options);

        $this->translationService->update($criteria, $translationEntity, $options);
    }

    public function testGetAvailableLocales()
    {
        $expectedResult = ['de_DE'];

        $mongoResult = [
            'values' => ['de_DE'],
            'stats' => [
                'n' => 2,
                'nscanned' => 0,
                'nscannedObjects' => 2,
                'timems' => 0,
                'planSummary' => 'COLLSCAN'
            ],
            'ok' => 1
        ];

        $this->translationRepository->expects($this->once())->method('distinct')->with('locale')->willReturn($mongoResult);

        $result = $this->translationService->getAvailableLocales();

        $this->assertEquals($expectedResult, $result);
    }

    public function testCountAvailableLocales()
    {
        $expectedResult = 1;

        $this->translationRepository->expects($this->once())->method('count')->willReturn($expectedResult);

        $result = $this->translationService->countAvailableLocales();

        $this->assertEquals($result, $expectedResult);
    }


}
