<?php

declare(strict_types=1);

namespace Arokettu\DateTime;

use DateTimeInterface;

/**
 * @template T of DateTimeInterface
 */
final class DateTimeTruncate
{
    public const TO_MICROSECONDS = 0;
    public const TO_MILLISECONDS = 1;
    public const TO_SECONDS = 2;
    public const TO_MINUTES = 3;
    public const TO_HOURS = 4;
    public const TO_DAYS = 5;
    public const TO_WEEKS = 6;
    public const TO_MONTHS = 7;
    public const TO_YEARS = 8;
    public const TO_ISO_YEARS = 9;

    /**
     * @param T $dateTime
     * @return T
     */
    public static function truncate(DateTimeInterface $dateTime, int $rounding): DateTimeInterface
    {
        // round mcs: noop
        if ($rounding <= self::TO_MICROSECONDS) {
            return $dateTime;
        }

        // round time
        if ($rounding <= self::TO_HOURS) {
            $ms = $rounding <= self::TO_MILLISECONDS ? \intval($dateTime->format('v')) : 0;
            $s  = $rounding <= self::TO_SECONDS ? \intval($dateTime->format('s')) : 0;
            $m  = $rounding <= self::TO_MINUTES ? \intval($dateTime->format('i')) : 0;
            $h  = \intval($dateTime->format('H'));

            $dateTime = $dateTime->setTime($h, $m, $s, $ms * 1000);

            return $dateTime;
        }

        $dateTime = $dateTime->setTime(0, 0, 0, 0);

        // if days, we're done
        if ($rounding <= self::TO_DAYS) {
            return $dateTime;
        }

        if ($rounding === self::TO_WEEKS || $rounding === self::TO_ISO_YEARS) {
            $w = $rounding <= self::TO_WEEKS ? \intval($dateTime->format('W')) : 1;
            $y = \intval($dateTime->format('o'));

            return $dateTime->setISODate($y, $w);
        }

        $m = $rounding <= self::TO_MONTHS ? \intval($dateTime->format('n')) : 1;
        $y = \intval($dateTime->format('Y'));

        return $dateTime->setDate($y, $m, 1);
    }

    public static function toMicroseconds(DateTimeInterface $innerClock): DateTimeInterface
    {
        return self::truncate($innerClock, self::TO_MICROSECONDS);
    }

    public static function toMilliseconds(DateTimeInterface $innerClock): DateTimeInterface
    {
        return self::truncate($innerClock, self::TO_MILLISECONDS);
    }

    public static function toSeconds(DateTimeInterface $innerClock): DateTimeInterface
    {
        return self::truncate($innerClock, self::TO_SECONDS);
    }

    public static function toMinutes(DateTimeInterface $innerClock): DateTimeInterface
    {
        return self::truncate($innerClock, self::TO_MINUTES);
    }

    public static function toHours(DateTimeInterface $innerClock): DateTimeInterface
    {
        return self::truncate($innerClock, self::TO_HOURS);
    }

    public static function toDays(DateTimeInterface $innerClock): DateTimeInterface
    {
        return self::truncate($innerClock, self::TO_DAYS);
    }

    public static function toWeeks(DateTimeInterface $innerClock): DateTimeInterface
    {
        return self::truncate($innerClock, self::TO_WEEKS);
    }

    public static function toMonths(DateTimeInterface $innerClock): DateTimeInterface
    {
        return self::truncate($innerClock, self::TO_MONTHS);
    }

    public static function toYears(DateTimeInterface $innerClock): DateTimeInterface
    {
        return self::truncate($innerClock, self::TO_YEARS);
    }

    public static function toIsoYears(DateTimeInterface $innerClock): DateTimeInterface
    {
        return self::truncate($innerClock, self::TO_ISO_YEARS);
    }
}
