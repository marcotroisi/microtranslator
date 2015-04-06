<?php
/**
 * @author Rocket Internet AG
 * @copyright Copyright (c) 2015 Rocket Internet AG, Johannistraße 20, 10117 Berlin, http://www.rocket-internet.de
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