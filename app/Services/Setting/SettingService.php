<?php
namespace App\Services\Setting;

use App\Models\Setting;
use Illuminate\Support\Facades\Redis;

class SettingService
{
    public function setSettingRedis()
    {
        $redis = Redis::connection();
        $data = Setting::first();
        $redis->set('setting', $data);
    }

    public function getSettingRedis()
    {
        $redis = Redis::connection();
        $data = json_decode($redis->get('setting'));
        if (empty($data))
            $data = Setting::first();
        return $data;
    }
}