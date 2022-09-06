<?php

namespace Rutatiina\FinancialAccounting\Models;

use Illuminate\Database\Eloquent\Model;
use Rutatiina\FinancialAccounting\Classes\AccountClass;
use Spatie\Activitylog\Traits\LogsActivity;
use Rutatiina\Tenant\Scopes\TenantIdScope;

class FinancialAccountLedger extends Model
{
    use LogsActivity;

    protected static $logName = 'Account';
    protected static $logFillable = true;
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];
    protected static $logOnlyDirty = false;

    protected $connection = 'tenant';

    protected $table = 'rg_financial_account_ledgers';

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
    ];

    protected $guarded = ['id'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->table = config('database.connections.tenant.database') . '.' . $this->table;
    }

    public function validatorGetTable()
    {
        //NOTE - important
        //seems like in laravel 8, the unique validation uses [db_connection_name].[table name]
        //instead of the known usual [db_name].[table_name]
        return 'tenant.' . $this->table;
    }

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

    public static function findCode($code)
    {
        return static::where('code', $code)->first();
    }

    public function financial_account()
    {
        return $this->hasOne('Rutatiina\FinancialAccounting\Models\Account', 'financial_account_code', 'code');
    }

}
