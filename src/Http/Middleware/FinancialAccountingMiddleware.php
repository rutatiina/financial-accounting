<?php

namespace Rutatiina\FinancialAccounting\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Rutatiina\Qbuks\Models\ServiceUser;

class FinancialAccountingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if(!Auth::check()) {
            return redirect(route('login'));
        }

    	if (session('tenant_id')) {
    		//do nothing //return $next($request);
		} else {
            return redirect(route('organisations.create'));
        }

        $user = $request->user();
        $tenant = $user->tenant;

        //get all the services of the user
        $service = null;
        $services = $user->services->where('service_id', 1); //Accounting;

        foreach ($services as $value) {
            if ($value->tenant_id == $tenant->id) {
                $service = $value;
            }
        }

        if (!$service) {
            $service = $services->first(); //get 1st  item in collection
        }

		if($service) {

			$service->load('tenant');

			//var_dump($service->tenant->id); exit;

			session(['tenant_id' => $service->tenant->id]);

			$db = $service->tenant->database;
    		//$db = (empty($db)) ? env('TENANT_DATABASE') : $db; // << env() failed to read the config file, thus the database parameter MUST always be set

    		//Log::info('service db: '.$db);

    		//change to tenant db
			config(['database.connections.tenant.database' => $db]);

			//Using purge() and reconnect() will ensure any query that runs in the future on the tenant connection will use the configuration from above.
			DB::purge('tenant');
			DB::reconnect('tenant');

		} else {
			session(['tenant_id' => 0]);

			return redirect(route('organisations.create'));
		}

        return $next($request);
    }
}
