<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace SIGA\FileManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use SIGA\Models\AbstractModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use SIGA\FileManager\Filters\FileManagerFilters;

class FileManager extends AbstractModel
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

    protected $appends = ['state','link_url', 'time'];


    public function getStateAttribute(){
        return 1;
    }
    
    public function folders()
    {
        return $this->hasMany(FileManager::class)->whereType('dir');
    }

    
    public function files()
    {
        return $this->hasMany(FileManager::class)->whereType('file');
    }
    
    public function folder()
    {
        return $this->hasOne(FileManager::class, 'file_manager_id')->whereType('dir');
    }
    
    public function getDirAttribute()
    {
        return $this->hasOne(FileManager::class);
    }
    
    public function subs()
    {
        return $this->hasMany(FileManager::class)->with(['folder'])->whereType('dir');
    }
    
    public function previews()
    {
        return $this->hasMany(FileManager::class)->with(['folder', 'previews'])->whereType('dir');
    }

    public function getLinkUrlAttribute(){
        return Storage::url( $this->getOriginal('url'));
    }

    public function getTimeAttribute(){
        return \Carbon\Carbon::parse($this->updated_at)->diffForHumans();
    }
    
    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new FileManagerFilters($request))->add($filters)->filter($builder);
    }
}