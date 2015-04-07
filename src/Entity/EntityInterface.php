<?php
/**
 * @author Marco Troisi
 * @created 04.04.15
 */

namespace MicroTranslator\Entity;

use MongoId;

interface EntityInterface
{
    /**
     * Returns Document's ID
     *
     * @return MongoId|mixed
     */
    public function getId();

    /**
     * Sets Document's ID
     *
     * @param $id
     * @return EntityInterface
     */
    public function setId($id);

}