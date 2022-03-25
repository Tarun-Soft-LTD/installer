<?php

namespace NirapodSoft\Installer\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use NirapodSoft\Installer\Helpers\CoreRepository;
use NirapodSoft\Installer\Helpers\PermissionChecker;
use NirapodSoft\Installer\Helpers\RequirementsChecker;

class InstallController extends Controller
{
    protected $requirements;
    protected $permissions;

    public function __construct(RequirementsChecker $requirements,PermissionChecker $permissions)
    {
        $this->requirements = $requirements;
        $this->permissions = $permissions;
    }
    public function index()
    {
        self::setEnvValue('APP_URL',URL::to('/'));
        return view('installer::installation');
    }

    public function permission()
    {
        $requirements = $this->requirements->check(config('nirapodInstaller.requirements'));
        $phpSupportInfo = $this->requirements->checkPHPversion(
            config('nirapodInstaller.minPHPVersion')
        );
        $permissions = $this->permissions->check(
            config('nirapodInstaller.permissions')
        );
        return view('installer::permissions',['permissions' => $permissions,'phpSupportInfo' => $phpSupportInfo,'requirements' => $requirements ]);
    }

    public function purchaseCode()
    {
        return view('installer::purchase_code');
    }
    public function database()
    {
        return view('installer::database');
    }
    public function purchaseCodeRedirect(Request $request)
    {
        self::setEnvValue('PURCHASE_CODE',$request->purchase_code);
        
        return redirect()->route('database');
    }
    public function databaseInstallation(Request $request)
    {
        if(is_array($request->keys)){
            foreach ($request->keys as $db_key) {
                $this->setEnvValue($db_key, $request[$db_key]);
            }
            Artisan::call('config:clear');
            if(self::isDBConnected()){
                return redirect()->route('administrator.setup');
            }
        }
        return back()->with('error','error');
    }

    public function administratorSetup()
    {
        Artisan::call('config:clear');
        if(self::isDBConnected()){
            return view('installer::administrator_setup');
        }
        return redirect()->route('database.installation')->with('error','error');
    }
    public function administratorSetupUser(Request $request)
    {
        if(self::isDBConnected()){
            $request->validate([
                'admin_name' => 'required',
                'admin_email' => 'required|email',
                'admin_password' => 'required|min:6'
            ]);
            User::updateOrCreate([
                'email' => $request->admin_email,
            ],[
                'email_verified_at' => now(),
                'user_type' => 'super_admin',
                'name' => $request->admin_name,
                'password' => Hash::make($request->admin_password)
            ]);
            self::installedApp();
            return redirect()->route('installation.success');
        }
        return redirect()->route('database')->with('errorMsg','Database connection not established. Please provide correct info.');

    }
    public function isDBConnected()
    {
        Artisan::call('config:clear');
        try {
            DB::connection();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
        // $db_host = env('DB_HOST');
        // $db_name = env('DB_DATABASE');
        // $db_user = env('DB_USERNAME');
        // $db_pass = env('DB_PASSWORD');
        // if(@mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
        //     return true;
        // }else {
        //     return false;
        // }

    }

    public function installationSuccess()
    {
        CoreRepository::analysis();
        if(file_exists(storage_path('installed'))){
            return view('installer::installation_success');
        }
    }
    public function setEnvValue($key, $value){
        $path = app()->environmentFilePath();
        $env = file_get_contents($path);
        $old_value = env($key);
        if (!str_contains($env, $key.'=')) {
            $env .= sprintf("%s=%s\n", $key, $value);
        } else if ($old_value) {
            $env = str_replace(sprintf('%s=%s', $key, $old_value), sprintf('%s=%s', $key, $value), $env);
        } else {
            $env = str_replace(sprintf('%s=', $key), sprintf('%s=%s',$key, $value), $env);
        }
        file_put_contents($path, $env);
        Artisan::call('config:clear');
    }
    public function installedApp()
    {
        $installedLogFile = storage_path('installed');

        $dateStamp = date('Y/m/d h:i:sa');

        if (!file_exists($installedLogFile)) {
            $message = config('nirapodInstaller.scriptName')." is successfully installed on".$dateStamp."\n";

            file_put_contents($installedLogFile, $message);
        } else {
            $message = config('nirapodInstaller.scriptName')." is successfully updated on".$dateStamp;

            file_put_contents($installedLogFile, $message.PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        return $message;
    }
}