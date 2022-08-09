<?php
namespace App\Models;
use CodeIgniter\Model;

class CommentModel extends Model{
    protected $table = 'comment';

    protected $allowedFields = [
        'text',
        'userID',
        'videoID',
        'date'
    ];

    public function getComments($id)
    {
        $query = 'SELECT c.id, c.videoID, c.text, u.firstName, u.lastName FROM comment c INNER JOIN user u ON c.userID = u.id INNER JOIN video v ON c.videoID = v.id WHERE c.videoID = ' . $id;

        return $this->db->query($query)->getResultArray();
    }
}