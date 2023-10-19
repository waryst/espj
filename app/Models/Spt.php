<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spt extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];
    public function pegawaispt()
    {
        return $this->hasMany(PegawaiSpt::class);
    }
    public function penandatanganspt()
    {
        return $this->belongsTo(PenandatanganSpt::class);
    }
}
