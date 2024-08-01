<?php

namespace app\user\cache;

use constant\cache\CachePress;
use constant\SysConfig;
use support\Redis;
use Webman\Context;

class VisitorCount
{

    private function getVisitorCountKey()
    {
        return CachePress::VISITOR_COUNT;
    }

    public function addVisitor($visitorId)
    {
        $userCountKey = $this->getVisitorCountKey();
        Redis::zAdd($userCountKey, time() + SysConfig::ONLINE_TIME, $visitorId);
    }

    public function getVisitorList(): ?array
    {
        $userCountKey = $this->getVisitorCountKey();
        return Redis::zRangeByScore($userCountKey, time(), time() + SysConfig::ONLINE_TIME);
    }

    public function getVisitorCount(): ?int
    {
        $userCountKey = $this->getVisitorCountKey();
        return Redis::zCount($userCountKey, time(), time() + SysConfig::ONLINE_TIME);
    }

    public function removeVisitor($visitorId)
    {
        $userCountKey = $this->getVisitorCountKey();

        Redis::zRem($userCountKey, $visitorId);
    }

    public function clearVisitor()
    {
        $userCountKey = $this->getVisitorCountKey();
        Redis::zRemRangeByScore($userCountKey, -1, time() - SysConfig::ONLINE_TIME);
    }
}