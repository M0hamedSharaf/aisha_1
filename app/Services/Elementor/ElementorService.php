<?php
namespace App\Services\Elementor;

use App\Models\Elementor;
use Illuminate\Support\Facades\Redis;

class ElementorService
{
    public function setElementorsRedis()
    {
        $redis = Redis::connection();
        $data = Elementor::get();
        $redis->set('elementors', $data);
    }

    public function getElementorsRedis()
    {
        $redis = Redis::connection();
        $data = json_decode($redis->get('elementors'));
        if (empty($data))
            $data = Elementor::get();
        return $data;
    }
}