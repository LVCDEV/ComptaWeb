<?php

namespace App\Models;

use App\Models\Admin\AccountType;
use App\Models\Admin\Bank;
use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperAccount
 */
class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'account_type_id',
        'user_id',
        'bank_id',
        'balance',
    ];

    protected $attributes = [
        'balance' => 0.00
    ];

    public function bank() : BelongsTo {
        return $this->belongsTo(Bank::class);
    }

    public function accountType() : BelongsTo {
        return $this->belongsTo(AccountType::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
