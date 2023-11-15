<?php

use Arokettu\DateTime\DateTimeTruncate;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

require __DIR__ . '/../vendor/autoload.php';

$d = new DateTimeImmutable();
var_dump(DateTimeTruncate::toMonths($d));

$d = new DateTime();
DateTimeTruncate::toDays($d);
var_dump($d);

$d = new CarbonImmutable();
var_dump(DateTimeTruncate::toHours($d));

$c = new Carbon();
DateTimeTruncate::toMilliseconds($c)->locale;
var_dump($c);
