<?php

namespace NirapodSoft\Installer\Helpers;

use Illuminate\Support\Facades\Http;

class CoreRepository{
    public static function analysis(){
        try {
            $response = Http::withOptions([
                'verify' => false,
            ])->post(config('nirapodInstaller.activationURL'),[
                'purchase_code' => env('PURCHASE_CODE'),
                'url' => url('/'),
                'product_name' => config('nirapodInstaller.scriptName'),
            ]);

            if($response->successful()){
                return json_decode($response->body())->activation_status;
            }
        } catch (\Throwable $th) {
            return [
                'activation_status' => 0
            ];
        }

    }
}