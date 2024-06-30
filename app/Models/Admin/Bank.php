<?php

namespace App\Models\Admin;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperBank
 */
class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'advise',
        'advise_phone',
        'advise_email',
        'address',
        'zipcode',
        'street',
        'city',
        'phone',
        'email',
        'website',
        'user_id',
    ];

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
