<?php
namespace Heartsentwined\Geoname\Repository;

use Doctrine\ORM\EntityRepository;
use Heartsentwined\ArgValidator\ArgValidator;
use Heartsentwined\Geoname\Exception;

/**
 * Feature
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Feature extends EntityRepository
{
    /**
     * findByGeonameCode
     *
     * @param string $code [feature class].[feature code]
     *      e.g. A.ADM1
     * @return Feature|null
     */
    public function findByGeonameCode($code)
    {
        ArgValidator::assert($code, 'string');
        $codeParts = explode('.', $code);
        if (count($codeParts) !== 2) {
            throw new Exception\InvalidArgumentException(sprintf(
                '$code should be in the format '
                . '[feature class].[feature code], e.g. "A.ADM1". '
                . '"%s" given',
                $code
            ));
        }

        list($parentCode, $featureCode) = $codeParts;

        $dqb = $this->_em->createQueryBuilder();
        $dqb->select(array('f'))
            ->from('Heartsentwined\Geoname\Entity\Feature', 'f')
            ->join('f.parent', 'p')
            ->where($dqb->expr()->andX(
                $dqb->expr()->eq('p.code', ':parentCode'),
                $dqb->expr()->eq('f.code', ':featureCode')
            ))
            ->setParameters(array(
                'parentCode'    => $parentCode,
                'featureCode'   => $featureCode,
            ));

        if ($features = $dqb->getQuery()->getResult()) {
            return current($features);
        } else {
            return null;
        }
    }
}