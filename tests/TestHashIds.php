<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../support/bootstrap.php';


use PHPUnit\Framework\TestCase;

class TestHashIds extends TestCase
{
    public function testAppConfig()
    {

        $id       = 1132423423423432222;
        $encodeId = id_encode($id);

        $decodeId = id_decode($encodeId);
        $data     = [
            'id'        => $id,
            'encode_id' => $encodeId,
            'decode_id' => $decodeId,
        ];

        echo json_encode($data, true);
    }
}