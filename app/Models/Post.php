<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use SIGA\FileManager\Models\FileManager;
use SIGA\Models\AbstractModel;

class Post extends AbstractModel
{
    use HasFactory;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    
    public $with = ['filemanager','category'];

    public function fileManager()
    {
        return $this->belongsTo(FileManager::class)->with('folder');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
