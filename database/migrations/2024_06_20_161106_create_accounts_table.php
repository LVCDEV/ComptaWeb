<?php

use App\Models\Admin\AccountType;
use App\Models\Admin\Bank;
use App\Models\Admin\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignIdFor(AccountType::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Bank::class)->nullable()->constrained()->cascadeOnDelete();
            $table->float('balance', 10, 2);
            $table->timestamps();
        });

        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('account_types');
    }
};
