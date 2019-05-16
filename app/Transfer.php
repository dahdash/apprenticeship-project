<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = ['task_id', 'to_user_id', 'status'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }
}
