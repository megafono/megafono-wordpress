<?php
/**
 * Class Megafono
 *
 * @package Megafono
 */

/**
 * Sample test case.
 */
class MegafonoWordpressTest extends WP_UnitTestCase {
    function test_is_megafono_url() {
        $megafono = new MegafonoWordpress();
        $this->assertTrue($megafono->is_megafono_url("megafono.host/e/test-episode") );
        $this->assertTrue($megafono->is_megafono_url("megafono.host/podcast/test/e/test-episode") );
        $this->assertTrue($megafono->is_megafono_url("megafono.host/podcast/test/e/123test-episode") );
        $this->assertTrue($megafono->is_megafono_url("megafono.host/e/?test-episode") );
        $this->assertTrue($megafono->is_megafono_url("megafono.host/?e/test-episode") );
        $this->assertTrue($megafono->is_megafono_url("megafono.host/e/test episode") );
        $this->assertFalse($megafono->is_megafono_url("megafonohost.test/e/test episode") );
    }
}
