<?php
namespace App\Models;
use CodeIgniter\Model;

class RatingModel extends Model{
    protected $table = 'rating';

    protected $allowedFields = [
        'userID',
        'videoID',
        'stars',
    ];

    public function userRating($userID, $videoID, $rating)
    {
        $query = 'SELECT * FROM rating WHERE userID =' . $userID . ' AND videoID = ' . $videoID;
        $result = $this->db->query($query)->getNumRows();

        if ($result > 0) {
            $ratingID = $this->db->query($query)->getRowArray()['id'];
            $this->update($ratingID,['stars' => $rating, 'userID' => $userID, 'videoID' => $videoID]);
        } else {
            $this->insert(['stars' => $rating, 'userID' => $userID, 'videoID' => $videoID]);
        }

        $query2 = 'SELECT AVG(stars) AS averageRating FROM rating WHERE videoID = ' . $videoID;

        $result2 = $this->db->query($query2)->getResultArray();

        $rating = $result2[0]['averageRating'];

        if ($rating == '') {
            $rating = 0;
        }
        return $rating;
    }

    public function averagePerVideo($userID) {

        $query = 'SELECT videoID, AVG(stars) AS averageRating FROM rating WHERE userID = ' . $userID . ' GROUP BY videoID';
        $result = $this->db->query($query)->getResultArray();
        return $result;
    }
}