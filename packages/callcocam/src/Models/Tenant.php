<?php
/**
* Created by Bengs.
* User: contato@bengs.com.br
* https://bengs.com.br
*/
namespace SIGA\Models;

use SIGA\Models\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Tenant extends AbstractModel
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['address'];
    
    
    public function getRouteTenantUpdateAttribute()
    {

        return route('api.tenant.update');
    }

    public function getRouteTenantDestroyAttribute()
    {
        return route('api.tenant.destroy');
    }

    public function getRouteAddressUpdateAttribute()
    {
        return route('api.tenant.update.address');
    }

    /**
     * Get the tenant's addressable.
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function isTenant()
    {
        return false;
    }
}
