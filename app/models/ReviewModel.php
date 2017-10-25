<?php

namespace App\Models;
use function var_dump;


/**
 * Class ReviewModel
 * @package App\Models
 */
class ReviewModel extends BaseModel
{

    public function getAllReviews()
    {
        $result = $this->_db->fetchAll("SELECT * FROM reviews");
        return $result;
    }

    public function getReview($id){
        $qb = $this->_db->createQueryBuilder();


        $qb
            ->select('id', 'name')
            ->from('reviews')
            ->where('id = ?')
            ->setParameter(0, $id)
        ;

        $query = $qb;


       var_dump($query);

    }
}