<?php
namespace BsDirectory\Model\Mapper\ODM\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use BsDirectory\Model\Mapper\DirectoryProfileRepositoryInterface;
use BsDirectory\Model\Mapper\DirectoryProfileInterface;
use BsCategory\Model\Mapper\CategoryInterface;
use BsGeo\Model\Mapper\ODM\Document\Coordinates2dSphere;
use BsGeo\Model\Mapper\GeoPlaceInterface;
use BsGeo\Model\Mapper\GeoCenteredInterface;
use Doctrine\ODM\MongoDB\Query\Builder;
use BsGeo\Library\Geo;

/**
 * Repository class for files
 */
class DirectoryProfileRepository extends DocumentRepository implements DirectoryProfileRepositoryInterface
{

    /*
     * (non-PHPdoc)
     * @see \BsDirectory\Model\Mapper\DirectoryProfileRepositoryInterface::findByCategory()
     */
    public function findByCategory(\BsCategory\Model\Mapper\CategoryInterface $category)
    {
        // TODO Auto-generated method stub
    }

    /*
     * (non-PHPdoc)
     * @see \BsDirectory\Model\Mapper\DirectoryProfileRepositoryInterface::findByParams()
     */
    public function findByParams(array $params = array(), array $flags = array())
    {
        $qb = $this->createQueryBuilder();
        
        if (in_array(DirectoryProfileRepositoryInterface::DIRECTORY_REPOSITORY_MINIMAL, $flags)) {
            if (isset($params['fields']) && is_array($params['fields'])) {
                $params = $params['fields'];
            } else {
                $params = [
                    'name',
                    'status',
                    'start',
                    'end',
                    'contact.email'
                ];
            }
            $qb->select($params);
        }
        
        if (in_array(DirectoryProfileRepositoryInterface::DIRECTORY_REPOSITORY_PUBLIC, $flags)) {
            $qb->field('status')->equals(DirectoryProfileInterface::DIRECTORY_PROFILE_STATUS_PUBLISHED);
        }
        
        // TODO associate with CategoryStrategy
        if (isset($params['category']) && $params['category'] instanceof CategoryInterface) {
            $qb->field('category.category.$id')->equals(new \MongoId($params['category']->getId()));
        }
        
        if (isset($params['keyword']) && is_string($params['keyword'])) {
            $qb->field('name')->equals(new \MongoRegex('/' . $params['keyword'] . '/i'));
        }
        
        if (isset($params['geo'])) {
            if ($params['geo'] instanceof Coordinates2dSphere) {
                $this->prepareGeoQuery($qb, $params['geo']);
            } elseif ($params['geo'] instanceof GeoPlaceInterface) {
                
                if ($params['geo'] instanceof GeoCenteredInterface) {
                    $this->prepareGeoQuery($qb, $params['geo']->getCoordinates());
                } elseif (isset($params['geo_field']) && is_string($params['geo_field'])) {
                    $qb->field($params['geo_field'])->references($params['geo']);
                } else {
                    throw new \Exception('Could not resolve GEO object');
                }
            }
        }
        $query = $qb->getQuery();
        $result = $query->execute();
        return $result;
    }

    /**
     *
     * @param Builder $qb            
     * @param Coordinates2dSphere $coords            
     */
    private function prepareGeoQuery(Builder $qb, Coordinates2dSphere $coords, $distance = 10)
    {
        $qb->field('coordinates.loc')->equals(array(
            '$near' => array(
                '$geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        $coords->getLongitude(),
                        $coords->getLatitude()
                    )
                ),
                '$maxDistance' => ($distance*Geo::METRES_IN_MILE)
            )
        ));
    }
}