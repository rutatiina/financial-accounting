<?php

namespace Rutatiina\FinancialAccounting\Models\Forex;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpenExchangeRate extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logName = 'Account';
    protected static $logFillable = true;
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];
    protected static $logOnlyDirty = true;

    protected $connection = 'tenant';

    protected $table = 'rg_accounting_forex_open_exchange_rates';

    protected $primaryKey = 'id';

}
