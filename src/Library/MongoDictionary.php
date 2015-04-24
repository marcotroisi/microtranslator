<?php

/*
 * This file is an extension of the Moss Locale package
 *
 * (c) Marco Troisi <hello@marcotroisi.com>
 *
 */

namespace MicroTranslator\Library;
use Moss\Locale\Translator\DictionaryInterface;

/**
 * Basic array dictionary
 *
 * @package Moss Locale
 * @author  Michal Wachowski <wachowski.michal@gmail.com>
 */
class MongoDictionary implements DictionaryInterface
{
    protected $locale;
    protected $translations = [];
    /**
     * @var \MongoDb
     */
    private $db;
    /**
     * @var string
     */
    private $collection;
    /**
     * @var string
     */
    private $wordField;
    /**
     * @var string
     */
    private $translationField;

    /**
     * @param string $locale
     * @param array $translations
     */
    public function __construct($locale, \MongoDB $db, $collection = 'translations', $wordField = 'word', $translationField = 'translation')
    {
        $this->locale = $locale;
        $this->db = $db;
        $this->collection = $collection;
        $this->wordField = $wordField;
        $this->translationField = $translationField;
    }

    /**
     * Returns current locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Returns translation for set word or if missing - word
     *
     * @param string $word
     * @return string
     */
    public function getText($word)
    {
        $collection = $this->collection;
        $result = $this->db->$collection->findOne(['word' => $word]);

        if (!$result) {
            return null;
        }

        return $result['translation'];
    }

    /**
     * Adds new or updates entry to dictionary
     *
     * @param string $word
     * @param string $text
     * @return $this
     */
    public function setText($word, $text)
    {
        $collection = $this->collection;
        $this->db->$collection->insert([
            $this->wordField => $word,
            $this->translationField => $text,
            'locale' => $this->locale
        ], [], ['upsert' => true]);

        return $this;
    }

    /**
     * Gets translations
     *
     * @return array
     */
    public function getTranslations()
    {
        $collection = $this->collection;
        $result = $this->db->$collection->find();

        foreach ($result as $k => $res) {
            $this->translations[$res[$this->wordField]] = $res[$this->translationField];
        }

        return $this->translations;
    }

    /**
     * Set translations
     *
     * @param array $translations
     * @return $this
     */
    public function setTranslations(array $translations)
    {
        $this->translations = $translations;

        foreach ($translations as $word => $translation) {
            $this->setText($word, $translation);
        }

        return $this;
    }
}
