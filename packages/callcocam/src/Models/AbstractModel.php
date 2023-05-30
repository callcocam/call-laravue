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
use Illuminate\Http\Request;
use SIGA\Filters\Filters;
use SIGA\Models\Concerns\HasRoutes;
use SIGA\Sluggable\HasSlug;
use SIGA\Sluggable\SlugOptions;

abstract class AbstractModel extends Model
{
    use BelongsToTenants, ConcernsHasUlids, HasSlug, HasRoutes, SoftDeletes;


    public $incrementing = false;

    protected $keyType = "string";

    /**
     * The accessors to append to the model's
     *
     * @var array
     */
    protected $appends = [
        'show_router',
        'edit_router',
        'destroy_router',
        'actions'
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

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

    
    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new Filters($request))->add($filters)->filter($builder);
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
 
}
