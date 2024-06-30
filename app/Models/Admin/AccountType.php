<?php

namespace App\Models\Admin;

use App\Models\Account;
use App\Models\IdeHelperAccountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperAccountType
 */
class AccountType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
