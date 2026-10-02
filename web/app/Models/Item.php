<?php
namespace App\Models;
use App\Models\Concerns\BelongsToStore;
use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    use BelongsToStore;
    protected $guarded = [];
    public function sales() { return $this->hasMany(Sale::class); }
}
