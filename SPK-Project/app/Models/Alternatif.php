<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Alternatif extends Model
{
    protected $table = 'alternatif';
    protected $fillable = ['nama'];

    public function attributes() : BelongsToMany{
        return $this->belongsToMany(
            Attribute::class,
            'alternatif_has_attribute',
            'alternatif_id',
            'attribute_id'
        )->withPivot('skor');
    }
}
