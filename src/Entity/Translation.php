<?php
/**
 * @author Marco Troisi
 * @created 04.04.15
 */

namespace MicroTranslator\Entity;

use MongoId;

class Translation extends EntityAbstract implements EntityInterface
{
    public $_id;
    public $word;
    public $locale;
    public $translation;

    /**
     * Returns Document's ID
     *
     * @return MongoId|mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets Document's ID
     *
     * @param $id
     * @return EntityInterface
     */
    public function setId($id)
    {
        $this->_id = $id;
    }
}