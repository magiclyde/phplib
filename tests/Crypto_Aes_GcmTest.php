<?php

use Magiclyde\Phplib\Crypto\Aes\Gcm;
use PHPUnit\Framework\TestCase;

final class Crypto_Aes_GcmTest extends TestCase
{
    /**
     * @group crypto
     */
    public function testEncryptDecrypt()
    {
        $plaintext = '{"ai":"test-accountId","name":"某某某","idNum":"371321199012310912"}';
        $key = '2836e95fcd10e04b0069bb1ee659955b';

        $b64s = Gcm::encrypt($plaintext, $key);
        $this->assertNotEmpty($b64s);

        $p = Gcm::decrypt($b64s, $key);
        $this->assertEquals($plaintext, $p);
    }
}