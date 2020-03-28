<?php

namespace Firumon\Makhzun\Models;

use Firumon\Makhzun\Traits\ModelCreate;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Firumon\Makhzun\Traits\ModelSignatures;

class Model extends BaseModel
{
    use SoftDeletes;
    use ModelSignatures;
    use ModelCreate;

    protected $guarded = [];
}
