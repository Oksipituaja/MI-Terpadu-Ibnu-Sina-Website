<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'subject',
        'featured_image',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Cek apakah guru ini adalah Kepala Sekolah.
     * Deteksi otomatis dari kolom subject (jabatan).
     */
    public function getIsPrincipalAttribute(): bool
    {
        return str_contains(
            strtolower($this->subject ?? ''),
            'kepala sekolah'
        );
    }

    /**
     * Scope: urutkan berdasarkan sort_order lalu nama.
     * Kepala Sekolah (sort_order=0) akan selalu paling atas.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}