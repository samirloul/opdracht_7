<?php

namespace Tests\Unit;

use App\Services\VoertuigService;
use PHPUnit\Framework\TestCase;

class VoertuigServiceTest extends TestCase
{
    public function test_normalize_kenteken_uses_trim_and_uppercase(): void
    {
        $service = new VoertuigService();

        $this->assertSame('DRS-52-E', $service->normalizeKenteken(' drs-52-e '));
    }

    public function test_is_bouwjaar_readonly_returns_true_for_daf(): void
    {
        $service = new VoertuigService();

        $this->assertTrue($service->isBouwjaarReadonly('DAF'));
    }
}
