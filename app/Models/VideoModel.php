<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoModel extends Model
{
    protected $table = 'video';

    protected $allowedFields = [
        'title',
        'description',
        'category',
        'userID',
        'videoLocation',
        'createdAt',
        'updatedAt'
    ];

    public function getCategories()
    {
        $query = "select DISTINCT category from video";

        return $this->db->query($query)->getResultArray();
    }

    public function search($keyword)
    {
        $query = "select * from video where title like '%" . $keyword . "%'";

        return $this->db->query($query)->getResultArray();
    }
}