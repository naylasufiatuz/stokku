<?php
namespace App\Models\Concerns;

// Semua data otomatis dibatasi ke toko milik user yang sedang login.
trait BelongsToStore {
    protected static function bootBelongsToStore(): void {
        static::addGlobalScope('store', function ($q) {
            if (auth()->check()) $q->where($q->getModel()->getTable() . '.store_id', auth()->user()->store_id);
        });
        static::creating(function ($m) {
            if (auth()->check() && !$m->store_id) $m->store_id = auth()->user()->store_id;
        });
    }
}
