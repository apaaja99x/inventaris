<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Pinjam extends Model
{
    protected $table = 'detail_pinjam';
    protected $fillable = ['inventaris_id', 'jumlah', 'peminjaman_id'];

    public function inventory()
    {
    	return $this->belongsTo(Inventory::class, 'inventaris_id');
    }
    public function users()
    {
    	return $this->belongsTo(User::class);
    }
    public function peminjaman()
    {
    	return $this->belongsTo(Peminjaman::class);
    }
}
