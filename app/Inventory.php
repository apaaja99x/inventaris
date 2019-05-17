<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
	protected $table = 'inventaris';
    protected $fillable = ['nama', 'kondisi', 'keterangan', 'jumlah', 'jenis_id', 'tanggal_register', 'ruang_id', 'kode_inventaris', 'users_id', 'gambar'];
    protected $dates = ['tanggal_register'];

    public function jenis()
    {
    	return $this->belongsTo(Jenis::class);
    }
    public function ruang()
    {
    	return $this->belongsTo(Ruang::class);
    }
    public function users()
    {
    	return $this->belongsTo(User::class);
    }
    public function detail_pinjam()
    {
    	return $this->hasMany(Detail_Pinjam::class, 'inventaris_id', 'id');
    }
}
