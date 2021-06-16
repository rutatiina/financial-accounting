<?php

namespace Rutatiina\FinancialAccounting\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Scopes\TenantIdScope;

class AccountBalance extends Model
{
	/*
    use LogsActivity;

    protected static $logName = 'AccountBalance';
    protected static $logFillable = true;
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];
    protected static $logOnlyDirty = true;
    */

    protected $connection = 'tenant';

    protected $table = 'rg_accounting_account_balances';

    protected $primaryKey = 'id';

    protected $guarded = [];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantIdScope);
    }

}
