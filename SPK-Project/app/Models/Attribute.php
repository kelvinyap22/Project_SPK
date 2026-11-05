<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Attribute extends Model
{
    protected $table = 'attribute';
    protected $fillable = ['nama', 'bobot', 'jenis'];

    public function alternatifs(): BelongsToMany
    {
        return $this->belongsToMany(
            Alternatif::class, 
            'alternatif_has_attribute', 
            'attribute_id', 
            'alternatif_id'
        )->withPivot('skor');
    }
}
