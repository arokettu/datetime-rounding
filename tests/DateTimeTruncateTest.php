<?php

declare(strict_types=1);

namespace Arokettu\DateTime\Tests;

use Arokettu\DateTime\DateTimeTruncate;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class DateTimeTruncateTest extends TestCase
{
    public function testTruncate(): void
    {
        $c = new DateTimeImmutable('2023-04-05 03:26:08.123456 UTC');
        $f = "Y-m-d\\TH:i:s.uP"; // like RFC3339_EXTENDED but with microseconds

        $mcs = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_MICROSECONDS);
        self::assertEquals('2023-04-05T03:26:08.123456+00:00', $mcs->format($f));

        $ms = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_MILLISECONDS);
        self::assertEquals('2023-04-05T03:26:08.123000+00:00', $ms->format($f));

        $s = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_SECONDS);
        self::assertEquals('2023-04-05T03:26:08.000000+00:00', $s->format($f));

        $min = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_MINUTES);
        self::assertEquals('2023-04-05T03:26:00.000000+00:00', $min->format($f));

        $h = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_HOURS);
        self::assertEquals('2023-04-05T03:00:00.000000+00:00', $h->format($f));

        $d = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_DAYS);
        self::assertEquals('2023-04-05T00:00:00.000000+00:00', $d->format($f));

        $w = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_WEEKS);
        self::assertEquals('2023-04-03T00:00:00.000000+00:00', $w->format($f)); // 3 was Monday

        $mon = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_MONTHS);
        self::assertEquals('2023-04-01T00:00:00.000000+00:00', $mon->format($f));

        $y = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_YEARS);
        self::assertEquals('2023-01-01T00:00:00.000000+00:00', $y->format($f));

        $yIso = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_ISO_YEARS);
        self::assertEquals('2023-01-02T00:00:00.000000+00:00', $yIso->format($f)); // Jan 2 was Monday
    }

    public function testTruncateCustomTz(): void
    {
        $c = (new DateTimeImmutable('2023-04-05 03:26:08.123456 UTC'))
                ->setTimezone(new \DateTimeZone('Asia/Tokyo'));
        $f = "Y-m-d\\TH:i:s.uP"; // like RFC3339_EXTENDED but with microseconds

        $mcs = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_MICROSECONDS);
        self::assertEquals('2023-04-05T12:26:08.123456+09:00', $mcs->format($f));

        $ms = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_MILLISECONDS);
        self::assertEquals('2023-04-05T12:26:08.123000+09:00', $ms->format($f));

        $s = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_SECONDS);
        self::assertEquals('2023-04-05T12:26:08.000000+09:00', $s->format($f));

        $min = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_MINUTES);
        self::assertEquals('2023-04-05T12:26:00.000000+09:00', $min->format($f));

        $h = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_HOURS);
        self::assertEquals('2023-04-05T12:00:00.000000+09:00', $h->format($f));

        $d = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_DAYS);
        self::assertEquals('2023-04-05T00:00:00.000000+09:00', $d->format($f));

        $w = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_WEEKS);
        self::assertEquals('2023-04-03T00:00:00.000000+09:00', $w->format($f)); // 3 was Monday

        $mon = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_MONTHS);
        self::assertEquals('2023-04-01T00:00:00.000000+09:00', $mon->format($f));

        $y = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_YEARS);
        self::assertEquals('2023-01-01T00:00:00.000000+09:00', $y->format($f));

        $yIso = DateTimeTruncate::truncate($c, DateTimeTruncate::TO_ISO_YEARS);
        self::assertEquals('2023-01-02T00:00:00.000000+09:00', $yIso->format($f)); // Jan 2 was Monday
    }

    public function testTruncateHelpers(): void
    {
        $c = new DateTimeImmutable('2023-04-05 03:26:08.123456 UTC');
        $f = "Y-m-d\\TH:i:s.uP"; // like RFC3339_EXTENDED but with microseconds

        $mcs = DateTimeTruncate::toMicroseconds($c);
        self::assertEquals('2023-04-05T03:26:08.123456+00:00', $mcs->format($f));

        $ms = DateTimeTruncate::toMilliseconds($c);
        self::assertEquals('2023-04-05T03:26:08.123000+00:00', $ms->format($f));

        $s = DateTimeTruncate::toSeconds($c);
        self::assertEquals('2023-04-05T03:26:08.000000+00:00', $s->format($f));

        $min = DateTimeTruncate::toMinutes($c);
        self::assertEquals('2023-04-05T03:26:00.000000+00:00', $min->format($f));

        $h = DateTimeTruncate::toHours($c);
        self::assertEquals('2023-04-05T03:00:00.000000+00:00', $h->format($f));

        $d = DateTimeTruncate::toDays($c);
        self::assertEquals('2023-04-05T00:00:00.000000+00:00', $d->format($f));

        $w = DateTimeTruncate::toWeeks($c);
        self::assertEquals('2023-04-03T00:00:00.000000+00:00', $w->format($f)); // 3 was Monday

        $mon = DateTimeTruncate::toMonths($c);
        self::assertEquals('2023-04-01T00:00:00.000000+00:00', $mon->format($f));

        $y = DateTimeTruncate::toYears($c);
        self::assertEquals('2023-01-01T00:00:00.000000+00:00', $y->format($f));

        $yIso = DateTimeTruncate::toIsoYears($c);
        self::assertEquals('2023-01-02T00:00:00.000000+00:00', $yIso->format($f)); // Jan 2 was Monday
    }
}
