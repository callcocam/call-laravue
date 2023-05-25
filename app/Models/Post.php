<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids as ConcernsHasUlids;
use SIGA\FileManager\Models\FileManager;

class Post extends Model
{
    use HasFactory, ConcernsHasUlids;
    
    
    public $incrementing = false;

    protected $keyType = "string";

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d'
    ];

    public $with = ['filemanager'];

    public function fileManager()
    {
        return $this->belongsTo(FileManager::class);
    }
}
