<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Settings;
use Session;
use Auth;

class SettingMiddelware
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
        if(!Session::get('memberDetail')) {
          Auth::guard('member')->logout();
        }

        if(isset($_GET['referal_code'])) {
          $cookie_name  = config('settingConfig.dev_cookie_prefix').'m101RAE';
          setcookie($cookie_name, $_GET['referal_code'], strtotime("+".config('settingConfig.ref_cookie_days')." days"));
       }

        /* $getSetting   = settings::all();
        $val  =		"<?php \n";
        $val  .= 	"return [\n";
        foreach ($getSetting as $key => $value) {
            $val  .= " '".$value->setting_key."' => '".addslashes ($value->setting_value)."'  ,\n";
        }
        $val  .= 	"'cnf_maintenance' 			=> '".$request->input('cnf_maintenance')."',\n";
        $val  .= 	"];\n";
        			$filename = base_path().'/config/settingConfig.php';
        			$fp=fopen($filename,"w+");
        			fwrite($fp,$val);
        			fclose($fp); */

        return $next($request);
    }
}
