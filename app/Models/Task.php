<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $table = 'tasks';

    protected $fillable = [
        'description',
    ];

    public function isCompleted()
    {
        return $this->completed == false ? 'fa fa-check' : 'fa fa-times';
    }

    public function completedClassFind()
    {
        return $this->completed == false ? 'card todo' : 'card ready';
    }
}
