<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace SIGA\Models;

use SIGA\Models\Tenant as ModelsTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SIGA\Tenant\BelongsToTenants;
use SIGA\Tenant\Facades\Tenant;
use SIGA\Models\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids as ConcernsHasUlids;
use SIGA\Models\Concerns\HasRoutes;
use SIGA\Sluggable\HasSlug;
use SIGA\Sluggable\SlugOptions;

abstract class AbstractModel extends Model
{
    use BelongsToTenants, ConcernsHasUlids, HasSlug, HasRoutes, SoftDeletes;


    public $incrementing = false;

    protected $keyType = "string";

    public function disableTenant()
    {

        self::$landlord->disable();

        return $this;
    }

    public function isTenant()
    {
        return true;
    }

    public function user()
    {

        return $this->belongsTo(User::class);
    }
    public function tenant()
    {

        return $this->belongsTo(ModelsTenant::class);
    }


    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    public function scopeTenant(Builder $builder)
    {
        //        $builder->where('tenant_id', auth()->user()->tenant_id);
    }

    public function __destruct()
    {
        Tenant::enable();
    }

    /**
     * @return SlugOptions
     */
    public function getSlugOptions()
    {
        if (is_string($this->slugTo())) {
            return SlugOptions::create()
                ->generateSlugsFrom($this->slugFrom())
                ->saveSlugsTo($this->slugTo());
        }
    }


    public function getEditRouterAttribute()
    {
        return $this->getDataRoute('edit');
    }


    public function getShowRouterAttribute()
    {
        return $this->getDataRoute('show');
    }

    public function getDestroyRouterAttribute()
    {
        return $this->getDataRoute('destroy');
    }
    public function getFileRouterAttribute()
    {
        return $this->getDataRoute('file');
    }
    public function getFilesRouterAttribute()
    {
        return $this->getDataRoute('files');
    }
    public function getEditorRouterAttribute()
    {
        return $this->getDataRoute('editor');
    }
}
