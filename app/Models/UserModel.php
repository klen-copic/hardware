<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model{
    protected $table = 'user';

    protected $allowedFields = [
        'firstName',
        'lastName',
        'email',
        'password',
        'phoneNumber',
        'role',
    ];
}