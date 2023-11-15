# DateTime Rounding Helper for PHP

[![Packagist]][Packagist Link]
[![PHP]][PHP Link]
[![License]][License Link]
[![Gitlab pipeline status]][Gitlab Link]
[![Codecov]][Codecov Link]

[Packagist]: https://img.shields.io/packagist/v/arokettu/datetime-rounding.svg?style=flat-square
[PHP]: https://img.shields.io/packagist/php-v/arokettu/datetime-rounding.svg?style=flat-square
[License]: https://img.shields.io/github/license/arokettu/datetime-rounding.svg?style=flat-square
[Gitlab pipeline status]: https://img.shields.io/gitlab/pipeline/sandfox/datetime-rounding/master.svg?style=flat-square
[Codecov]: https://img.shields.io/codecov/c/gl/sandfox/datetime-rounding?style=flat-square

[Packagist Link]: https://packagist.org/packages/arokettu/datetime-rounding
[PHP Link]: https://packagist.org/packages/arokettu/datetime-rounding
[License Link]: LICENSE.md
[Gitlab Link]: https://gitlab.com/sandfox/datetime-rounding/-/pipelines
[Codecov Link]: https://codecov.io/gl/sandfox/datetime-rounding/

A tool to truncate a DateTime instance to a specific time unit.

## Installation

```bash
composer require arokettu/datetime-rounding
```

## Example

```php
<?php

use Arokettu\DateTime\DateTimeTruncate;
use Carbon\CarbonImmutable;

// to hours
$dateTime = new DateTimeImmutable('2012-03-04T05:06:07.890123Z');
echo DateTimeTruncate::toHours($dateTime)->format('c'); // 2012-03-04T05:00:00+00:00

// truncating to dates uses the DT timezone
$dateTime = new DateTimeImmutable('2012-03-04T05:06:07.890123 Europe/Stockholm');
echo DateTimeTruncate::toMonths($dateTime)->format('c'); // 2012-03-01T00:00:00+01:00

// using mutable will change the object
$dateTime = new DateTime('2012-03-04T05:06:07.890123Z');
DateTimeTruncate::toMinutes($dateTime);
echo $dateTime->format('c'); // 2012-03-04T05:06:00+00:00

// the tool tries to preserve the extended objects as well
$dateTime = new CarbonImmutable('2012-03-04T05:06:07.890123Z');
echo get_class(DateTimeTruncate::toMonths($dateTime)); // Carbon\CarbonImmutable
```

## Documentation

Read full documentation here: <https://sandfox.dev/php/datetime-rounding.html>

## Support

Please file issues on our main repo at GitLab: <https://gitlab.com/sandfox/datetime-rounding/-/issues>

Feel free to ask any questions in our room on Gitter: <https://gitter.im/arokettu/community>

## License

The library is available as open source under the terms of the [MIT License](LICENSE.md).
