<?php

namespace App\Models\Admin;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperAmount
 */
class Amount extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'value'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
