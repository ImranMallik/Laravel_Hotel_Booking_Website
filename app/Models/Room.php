<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id', 'id');
        // Akhana Room_Type_Id = Room Model Ar R Id holo RoomType Model ar ;
    }


    public function multiimg()
    {
        return $this->belongsTo(MultiImage::class, 'id', 'rooms_id');
        // Akhana room_type_id = Room::Model Ar r id holo MultiImage::model ar;
    }
}
