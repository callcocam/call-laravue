<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Menus\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids as ConcernsHasUlids;

class Menu extends Model
{
    use HasFactory, ConcernsHasUlids;
    
    public $incrementing = false;

    protected $keyType = "string";

}
