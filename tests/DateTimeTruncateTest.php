<?php

declare(strict_types=1);

namespace Arokettu\DateTime\Tests;

use Arokettu\DateTime\DateTimeTruncate;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class DateTimeTruncateTest extends TestCase
{
    public function testTruncate(): void
    {
        $dt = new DateTimeImmutable('2023-04-05 03:26:08.123456 UTC');
        $f = "Y-m-d\\TH:i:s.uP"; // like RFC3339_EXTENDED but with microseconds

        $mcs = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_MICROSECONDS);
        self::assertEquals('2023-04-05T03:26:08.123456+00:00', $mcs->format($f));

        $ms = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_MILLISECONDS);
        self::assertEquals('2023-04-05T03:26:08.123000+00:00', $ms->format($f));

        $s = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_SECONDS);
        self::assertEquals('2023-04-05T03:26:08.000000+00:00', $s->format($f));

        $min = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_MINUTES);
        self::assertEquals('2023-04-05T03:26:00.000000+00:00', $min->format($f));

        $h = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_HOURS);
        self::assertEquals('2023-04-05T03:00:00.000000+00:00', $h->format($f));

        $d = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_DAYS);
        self::assertEquals('2023-04-05T00:00:00.000000+00:00', $d->format($f));

        $w = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_WEEKS);
        self::assertEquals('2023-04-03T00:00:00.000000+00:00', $w->format($f)); // 3 was Monday

        $mon = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_MONTHS);
        self::assertEquals('2023-04-01T00:00:00.000000+00:00', $mon->format($f));

        $y = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_YEARS);
        self::assertEquals('2023-01-01T00:00:00.000000+00:00', $y->format($f));

        $yIso = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_ISO_YEARS);
        self::assertEquals('2023-01-02T00:00:00.000000+00:00', $yIso->format($f)); // Jan 2 was Monday
    }

    public function testTruncateCustomTz(): void
    {
        $dt = (new DateTimeImmutable('2023-04-05 03:26:08.123456 UTC'))
                ->setTimezone(new \DateTimeZone('Asia/Tokyo'));
        $f = "Y-m-d\\TH:i:s.uP"; // like RFC3339_EXTENDED but with microseconds

        $mcs = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_MICROSECONDS);
        self::assertEquals('2023-04-05T12:26:08.123456+09:00', $mcs->format($f));

        $ms = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_MILLISECONDS);
        self::assertEquals('2023-04-05T12:26:08.123000+09:00', $ms->format($f));

        $s = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_SECONDS);
        self::assertEquals('2023-04-05T12:26:08.000000+09:00', $s->format($f));

        $min = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_MINUTES);
        self::assertEquals('2023-04-05T12:26:00.000000+09:00', $min->format($f));

        $h = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_HOURS);
        self::assertEquals('2023-04-05T12:00:00.000000+09:00', $h->format($f));

        $d = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_DAYS);
        self::assertEquals('2023-04-05T00:00:00.000000+09:00', $d->format($f));

        $w = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_WEEKS);
        self::assertEquals('2023-04-03T00:00:00.000000+09:00', $w->format($f)); // 3 was Monday

        $mon = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_MONTHS);
        self::assertEquals('2023-04-01T00:00:00.000000+09:00', $mon->format($f));

        $y = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_YEARS);
        self::assertEquals('2023-01-01T00:00:00.000000+09:00', $y->format($f));

        $yIso = DateTimeTruncate::truncate($dt, DateTimeTruncate::TO_ISO_YEARS);
        self::assertEquals('2023-01-02T00:00:00.000000+09:00', $yIso->format($f)); // Jan 2 was Monday
    }

    public function testTruncateHelpers(): void
    {
        $dt = new DateTimeImmutable('2023-04-05 03:26:08.123456 UTC');
        $f = "Y-m-d\\TH:i:s.uP"; // like RFC3339_EXTENDED but with microseconds

        $mcs = DateTimeTruncate::toMicroseconds($dt);
        self::assertEquals('2023-04-05T03:26:08.123456+00:00', $mcs->format($f));

        $ms = DateTimeTruncate::toMilliseconds($dt);
        self::assertEquals('2023-04-05T03:26:08.123000+00:00', $ms->format($f));

        $s = DateTimeTruncate::toSeconds($dt);
        self::assertEquals('2023-04-05T03:26:08.000000+00:00', $s->format($f));

        $min = DateTimeTruncate::toMinutes($dt);
        self::assertEquals('2023-04-05T03:26:00.000000+00:00', $min->format($f));

        $h = DateTimeTruncate::toHours($dt);
        self::assertEquals('2023-04-05T03:00:00.000000+00:00', $h->format($f));

        $d = DateTimeTruncate::toDays($dt);
        self::assertEquals('2023-04-05T00:00:00.000000+00:00', $d->format($f));

        $w = DateTimeTruncate::toWeeks($dt);
        self::assertEquals('2023-04-03T00:00:00.000000+00:00', $w->format($f)); // 3 was Monday

        $mon = DateTimeTruncate::toMonths($dt);
        self::assertEquals('2023-04-01T00:00:00.000000+00:00', $mon->format($f));

        $y = DateTimeTruncate::toYears($dt);
        self::assertEquals('2023-01-01T00:00:00.000000+00:00', $y->format($f));

        $yIso = DateTimeTruncate::toIsoYears($dt);
        self::assertEquals('2023-01-02T00:00:00.000000+00:00', $yIso->format($f)); // Jan 2 was Monday
    }

    public function testTypePreserve(): void
    {
        $f = "Y-m-d\\TH:i:s.uP"; // like RFC3339_EXTENDED but with microseconds

        // dt immutable
        $dt = new DateTimeImmutable('2023-11-14T22:28:59.596209+00:00');
        $dtTrunc = DateTimeTruncate::toDays($dt);
        self::assertEquals('2023-11-14T00:00:00.000000+00:00', $dtTrunc->format($f));
        self::assertEquals('2023-11-14T22:28:59.596209+00:00', $dt->format($f)); // check immutable
        self::assertEquals(DateTimeImmutable::class, \get_class($dtTrunc));

        // dt mutable
        $dt = new DateTime('2023-11-14T22:28:59.596209+00:00');
        $dtTrunc = DateTimeTruncate::toDays($dt);
        self::assertEquals('2023-11-14T00:00:00.000000+00:00', $dtTrunc->format($f));
        self::assertEquals('2023-11-14T00:00:00.000000+00:00', $dt->format($f)); // check mutable
        self::assertEquals(DateTime::class, \get_class($dtTrunc));

        // carbon immutable
        $dt = @new CarbonImmutable('2023-11-14T22:28:59.596209+00:00'); // external dev deprecation
        $dtTrunc = DateTimeTruncate::toDays($dt);
        self::assertEquals('2023-11-14T00:00:00.000000+00:00', $dtTrunc->format($f));
        self::assertEquals('2023-11-14T22:28:59.596209+00:00', $dt->format($f)); // check immutable
        self::assertEquals(CarbonImmutable::class, \get_class($dtTrunc));

        // carbon mutable
        $dt = @new Carbon('2023-11-14T22:28:59.596209+00:00'); // external dev deprecation
        $dtTrunc = DateTimeTruncate::toDays($dt);
        self::assertEquals('2023-11-14T00:00:00.000000+00:00', $dtTrunc->format($f));
        self::assertEquals('2023-11-14T00:00:00.000000+00:00', $dt->format($f)); // check mutable
        self::assertEquals(Carbon::class, \get_class($dtTrunc));
    }
}
