<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'attribute';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'bobot',
        'jenis'
    ];

    public function alternatif()
    {
        return $this->belongsToMany(
            Alternatif::class,
            'alternatif_has_attribute',
            'attribute_id',
            'alternatif_id'
        )->withPivot('skor');
    }
}
