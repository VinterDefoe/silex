<?php

namespace App\Models;


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
}