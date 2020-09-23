<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public function matkul()
    {
        return$this->hasOne(Matkul::class, 'matkul_id');
    }
}
