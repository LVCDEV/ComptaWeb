<?php

namespace App\Models;

use App\Models\Admin\TransactionType;
use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperTransaction
 */
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'transaction_type_id',
        'account_id',
        'beneficiary',
        'description',
        'date',
        'amount',
        'user_id',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function transaction_type() : BelongsTo {
        return $this->belongsTo(TransactionType::class);
    }

    public function account() : BelongsTo {
        return $this->belongsTo(Account::class);
    }
}
