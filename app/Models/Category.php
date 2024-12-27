<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use Database\Factories\CategoryFactory;

class Category extends Model
{
    
    protected $fillable = ['name', 'slug', 'description'];
    use HasFactory;

    /*protected static function newFactory() {
        return new CategoryFactory();
    }*/

        public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
