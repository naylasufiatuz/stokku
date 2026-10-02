<?php
namespace App\Models;
use App\Models\Concerns\BelongsToStore;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model {
    use BelongsToStore;
    protected $guarded = [];
    public function item() { return $this->belongsTo(Item::class); }
    public function user() { return $this->belongsTo(User::class); }
}
