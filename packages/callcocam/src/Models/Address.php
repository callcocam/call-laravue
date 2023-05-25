<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends AbstractModel
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

    /**
     * Get the parent addressable model (user or tenant).
     */

    public function addressable()
    {
        return $this->morphTo();
    }
}
