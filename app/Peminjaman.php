<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = ['id', 'tgl_pinjam', 'tgl_kembali', 'status_peminjaman', 'pegawai_id', 'users_id'];
    protected $dates = ['tgl_pinjam', 'tgl_kembali'];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
    public function detail_pinjam()
    {
    	return $this->hasOne(Detail_Pinjam::class);
    }
    public function pegawai()
    {
    	return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
