<?php

use App\Models\Account;
use App\Models\Admin\TransactionType;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TransactionType::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Account::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('beneficiary');
            $table->string('description');
            $table->date('date');
            $table->float('amount');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('coef');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('transaction_types');
    }
};
