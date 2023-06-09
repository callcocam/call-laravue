<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Makes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use SIGA\Models\AbstractModel;

class MakeBoardItem extends AbstractModel
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
        'options',
        'props',
    ];
    public function make_board_items_attributes()
    {
        return $this->hasMany(MakeBoardItemAttribute::class);
    }

    public function make_board_items_options()
    {
        return $this->hasMany(MakeBoardItemOption::class);
    }


    public function getOptionsAttribute()
    {
        return $this->make_board_items_options()->select([
            'id',
            'ordering',
            'name as value',
            'description as label',
        ])->get()->toArray();
    }


    public function getPropsAttribute()
    {
        return $this->make_board_items_attributes()->pluck('description', 'name')->toArray();
    }
}
