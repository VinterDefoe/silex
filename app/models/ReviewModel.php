<?php

namespace App\Models;


/**
 * Class ReviewModel
 * @package App\Models
 */
class ReviewModel extends BaseModel
{
    /**
     * @return mixed
     */
    public function getAllReviews()
    {
        return $this->_db->fetchAll("SELECT * FROM reviews");
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getReview($id)
    {
        $sql = "SELECT * FROM reviews WHERE id = ?";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * @param $name
     * @param $date
     * @param $ip
     * @param $reviews
     * @param $likes
     * @return bool
     */
    public function addReview($name, $date, $ip, $reviews, $likes)
    {
        $sql = "INSERT INTO reviews(name,\"date\",ip,reviews,likes) 
                VALUES (:name,:date,:ip,:reviews,:likes)";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue('name', $name);
        $stmt->bindValue('date', $date);
        $stmt->bindValue('ip', $ip);
        $stmt->bindValue('reviews', $reviews);
        $stmt->bindValue('likes', $likes);
        return $stmt->execute();
    }
}