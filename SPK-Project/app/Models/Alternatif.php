<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'alternatif';
    public $timestamps = false;

    protected $fillable = ['nama'];

    public function kriteria()
    {
        return $this->belongsToMany(
            Kriteria::class,
            'alternatif_has_attribute',
            'alternatif_id',
            'attribute_id'
        )->withPivot('skor');
    }
}
