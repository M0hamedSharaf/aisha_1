<?php

namespace Tests\Traits;

trait TestGeneralTrait
{
    private function assertResponseArrayHasKeys($res, array $keys)
    {
        $res_array = (array)json_decode($res->content());
        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $res_array);
        }
    }
}
