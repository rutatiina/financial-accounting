<?php

namespace Rutatiina\FinancialAccounting\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Rutatiina\Tenant\Scopes\TenantIdScope;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logName = 'Account';
    protected static $logFillable = true;
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];
    protected static $logOnlyDirty = true;

    protected $connection = 'tenant';

    protected $tableOnly = 'rg_accounting_accounts';
    protected $table = 'rg_accounting_accounts';

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
    ];

    protected $appends = ['balance'];

    protected $guarded = ['id'];

    protected static $currency = 'UGX';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->table = config('database.connections.tenant.database') . '.' . $this->table;
    }

    public static function setCurrency($value)
    {
        self::$currency = $value;
        return new static();
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

    public function rgGetAttributes()
    {
        $attributes = [];
        $describeTable = \DB::connection('tenant')->select('describe ' . $this->getTable());

        foreach ($describeTable as $row)
        {

            if (in_array($row->Field, ['id', 'created_at', 'updated_at', 'deleted_at', 'tenant_id', 'user_id'])) continue;

            if (in_array($row->Field, ['currencies', 'taxes']))
            {
                $attributes[$row->Field] = [];
                continue;
            }

            if ($row->Default == '[]')
            {
                $attributes[$row->Field] = [];
            }
            else
            {
                $attributes[$row->Field] = '';
            }
        }

        //add the relationships
        //$attributes['comments'] = [];

        return $attributes;
    }

    public function getBalanceAttribute()
    {
        $balances = AccountBalance::where('financial_account_code', $this->code)
            ->where('currency', self::$currency)
            ->orderBy('date', 'desc')
            ->first();

        if ($balances)
        {
            return $balances;
        }
        else
        {
            $data = new \stdClass();
            $data->currency = 'UGX';
            $data->debit = 0;
            $data->credit = 0;
            return $data;
        }
    }

    public function financial_account_category()
    {
        return $this->hasOne('Rutatiina\FinancialAccounting\Models\FinancialAccountCategory', 'code', 'financial_account_category_code');
    }

    public function getSearchableColumns()
    {
        return Schema::connection($this->connection)->getColumnListing($this->tableOnly);
    }

}
