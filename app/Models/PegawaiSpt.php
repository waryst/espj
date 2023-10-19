<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiSpt extends Model
{
    use HasFactory, HasUuids;
    public $id = false;
    protected $guarded = [];
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
