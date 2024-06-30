<?php

namespace App\Models\Admin;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperTransactionType
 */
class TransactionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'coef',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
