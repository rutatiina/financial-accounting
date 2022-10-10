<?php

namespace Rutatiina\FinancialAccounting\Models;

use Illuminate\Database\Eloquent\Model;
use Rutatiina\Tenant\Scopes\TenantIdScope;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class TxnEntreeConfig extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logName = 'TxnEntreeConfig';
    protected static $logFillable = true;
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];
    protected static $logOnlyDirty = true;

    protected $connection = 'tenant';

    protected $table = 'rg_accounting_txn_entree_configs';

    protected $primaryKey = 'id';

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

    public function txn_type()
    {
        return $this->hasOne('Rutatiina\FinancialAccounting\Models\TxnType', 'id', 'txn_type_id');
    }

    public function debit_account()
    {
        return $this->hasOne('Rutatiina\FinancialAccounting\Models\Account', 'id', 'debit');
    }

    public function credit_account()
    {
        return $this->hasOne('Rutatiina\FinancialAccounting\Models\Account', 'id', 'credit');
    }

}
