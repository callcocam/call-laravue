<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use SIGA\Models\AbstractModel;

class MakeField extends AbstractModel
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
     * The accessors to append to the model's
     *
     * @var array
     */
    protected $appends = [
        'show_router',
        'edit_router',
        'destroy_router',
        'actions',
        'options',
    ];

    public function make_field_options()
    {
        return $this->hasMany(MakeFieldOption::class);
    }

    public function getOptionsAttribute()
    {
        return $this->make_field_options()->pluck('description', 'name')->toArray();
    }
}
