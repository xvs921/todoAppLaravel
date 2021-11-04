<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $table = 'tasks';

    public $id;

    public $description;

    public $completed;

    protected $fillable = [
        'description',
    ];

    public function isCompleted()
    {
        return $this->completed == 0 ? 'Todo' : 'Ready';
    }
}
