<?php
/**
 * @author Marco Troisi
 * @created 04.04.15
 */

namespace MicroTranslator\Repository;


use MicroTranslator\Entity\EntityInterface;
use MongoDB;

abstract class RepositoryAbstract
{

    /**
     * @var MongoDB
     */
    protected $db;

    /**
     * @var string
     */
    protected $collection = '';

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param EntityInterface $entity
     * @return array|bool
     */
    public function save(EntityInterface $entity)
    {
        $collection = $this->collection;

        if ($entity->getId() == null) {
            $entity->setId(new \MongoId());
        }

        return $this->db->$collection->save($entity);
    }

    public function update($criteria, EntityInterface $entity, $options)
    {
        $collection = $this->collection;

        $entityArray = get_object_vars($entity);
        unset($entityArray['_id']);

        return $this->db->$collection->update($criteria, $entityArray, $options);
    }

    public function find($query, $fields = [])
    {
        $collection = $this->collection;

        return $this->db->$collection->find($query, $fields);
    }

    public function findOne($query, $fields = [])
    {
        $collection = $this->collection;

        return $this->db->$collection->findOne($query, $fields);
    }

    public function count($query)
    {
        $collection = $this->collection;

        return $this->db->$collection->count($query);
    }

}
