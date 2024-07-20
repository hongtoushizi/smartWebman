<?php

namespace library;

use app\api\defined\MeiTuanConfig;

class AES128
{
    private const bm      = "UTF-8";
    private const VIP_ARA = MeiTuanConfig::P; // 媒体平台取链获得的 p 参数
    private const ASE_KEY = MeiTuanConfig::P; // 媒体平台取链获得的 p 参数

    public static function encrypt($cleartext): string
    {
        try {
            $limitLength   = 16;
            $VIPARA_LL     = substr(self::VIP_ARA, 0, $limitLength); // 限制长度为 16 个字符
            $ASE_KEY_LL    = substr(self::ASE_KEY, 0, $limitLength); // 限制长度为 16 个字符
            $zeroIv        = $VIPARA_LL;
            $key           = $ASE_KEY_LL;
            $cipher        = "AES-128-CBC";
            $encryptedData = openssl_encrypt($cleartext, $cipher, $key, OPENSSL_RAW_DATA, $zeroIv);
            $base64Data    = base64_encode($encryptedData);
            return $base64Data;
        } catch (\Exception $e) {
            throw new \RuntimeException("encrypt Exception: " . $e->getMessage());
        }
    }
}
