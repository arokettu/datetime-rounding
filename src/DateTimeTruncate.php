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

            return $dateTime->setTime($h, $m, $s, $ms * 1000);
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

    /**
     * @param T $dateTime
     * @return T
     */
    public static function toMicroseconds(DateTimeInterface $dateTime): DateTimeInterface
    {
        return self::truncate($dateTime, self::TO_MICROSECONDS);
    }

    /**
     * @param T $dateTime
     * @return T
     */
    public static function toMilliseconds(DateTimeInterface $dateTime): DateTimeInterface
    {
        return self::truncate($dateTime, self::TO_MILLISECONDS);
    }

    /**
     * @param T $dateTime
     * @return T
     */
    public static function toSeconds(DateTimeInterface $dateTime): DateTimeInterface
    {
        return self::truncate($dateTime, self::TO_SECONDS);
    }

    /**
     * @param T $dateTime
     * @return T
     */
    public static function toMinutes(DateTimeInterface $dateTime): DateTimeInterface
    {
        return self::truncate($dateTime, self::TO_MINUTES);
    }

    /**
     * @param T $dateTime
     * @return T
     */
    public static function toHours(DateTimeInterface $dateTime): DateTimeInterface
    {
        return self::truncate($dateTime, self::TO_HOURS);
    }

    /**
     * @param T $dateTime
     * @return T
     */
    public static function toDays(DateTimeInterface $dateTime): DateTimeInterface
    {
        return self::truncate($dateTime, self::TO_DAYS);
    }

    /**
     * @param T $dateTime
     * @return T
     */
    public static function toWeeks(DateTimeInterface $dateTime): DateTimeInterface
    {
        return self::truncate($dateTime, self::TO_WEEKS);
    }

    /**
     * @param T $dateTime
     * @return T
     */
    public static function toMonths(DateTimeInterface $dateTime): DateTimeInterface
    {
        return self::truncate($dateTime, self::TO_MONTHS);
    }

    /**
     * @param T $dateTime
     * @return T
     */
    public static function toYears(DateTimeInterface $dateTime): DateTimeInterface
    {
        return self::truncate($dateTime, self::TO_YEARS);
    }

    /**
     * @param T $dateTime
     * @return T
     */
    public static function toIsoYears(DateTimeInterface $dateTime): DateTimeInterface
    {
        return self::truncate($dateTime, self::TO_ISO_YEARS);
    }
}
