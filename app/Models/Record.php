<?php 
namespace App\Models;
use CodeIgniter\Model;
class RecordModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['vehicleno', 'office', 'images', 'user_id'];
}