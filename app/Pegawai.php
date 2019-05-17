<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $fillable = ['nama_pegawai', 'nip', 'alamat'];

    public function peminjaman()
    {
    	return $this->hasMany(Peminjaman::class, 'pegawai_id', 'id');
    }
}
