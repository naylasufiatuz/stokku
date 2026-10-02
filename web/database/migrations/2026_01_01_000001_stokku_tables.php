<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('stores', function (Blueprint $t) { $t->id(); $t->string('name'); $t->timestamps(); });
        Schema::table('users', function (Blueprint $t) {
            $t->string('role')->default('pemilik');
            $t->unsignedBigInteger('store_id')->nullable()->index();
        });
        Schema::create('items', function (Blueprint $t) {
            $t->id();
            $t->foreignId('store_id')->constrained()->cascadeOnDelete();
            $t->string('name'); $t->string('category');
            $t->unsignedInteger('buy_price'); $t->unsignedInteger('sell_price');
            $t->integer('stock')->default(0); $t->integer('min_stock')->default(5);
            $t->timestamps();
        });
        Schema::create('sales', function (Blueprint $t) {
            $t->id();
            $t->foreignId('store_id')->constrained()->cascadeOnDelete();
            $t->foreignId('item_id')->constrained()->cascadeOnDelete();
            $t->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $t->unsignedInteger('qty'); $t->unsignedInteger('price');
            $t->date('sold_on')->index();
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('sales'); Schema::dropIfExists('items'); Schema::dropIfExists('stores');
    }
};
