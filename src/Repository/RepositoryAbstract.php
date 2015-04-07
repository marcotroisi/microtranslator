<?php
/**
 * @author Marco Troisi
 * @created 04.04.15
 */

namespace MicroTranslator\Repository;


use MicroTranslator\Entity\EntityInterface;

abstract class RepositoryAbstract
{

    protected $db;
    protected $collection = '';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function save(EntityInterface $entity)
    {
        $collection = $this->collection;

        if ($entity->getId() == null) {
            $entity->setId(new \MongoId());
        }

        $this->db->$collection->save($entity);
    }

}
