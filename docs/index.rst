DateTime Rounding
#################

.. highlight:: php

|Packagist| |GitLab| |GitHub| |Codeberg| |Gitea|

A tool to truncate a DateTime instance to a specific time unit.

Installation
============

.. code-block:: bash

   composer require 'arokettu/datetime-rounding'

Documentation
=============

::

    <?php

    use Arokettu\DateTime\DateTimeTruncate;
    use Carbon\CarbonImmutable;

    // to hours
    $dateTime = new DateTimeImmutable('2012-03-04T05:06:07.890123Z');
    echo DateTimeTruncate::toHours($dateTime)->format('c'); // 2012-03-04T05:00:00+00:00
    // or
    echo DateTimeTruncate::truncate($dateTime, DateTimeTruncate::TO_HOURS)->format('c'); // same

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

Supported precisions:

* microseconds (``DateTimeTruncate::TO_MICROSECONDS``)
* milliseconds (``DateTimeTruncate::TO_MILLISECONDS``)
* seconds (``DateTimeTruncate::TO_SECONDS``)
* minutes (``DateTimeTruncate::TO_MINUTES``)
* hours (``DateTimeTruncate::TO_HOURS``)
* days (``DateTimeTruncate::TO_DAYS``)
* ISO weeks (``DateTimeTruncate::TO_WEEKS``)
* months (``DateTimeTruncate::TO_MONTHS``)
* calendar years (``DateTimeTruncate::TO_YEARS``)
* ISO years (``DateTimeTruncate::TO_ISO_YEARS``)

License
=======

The library is available as open source under the terms of the `MIT License`_.

.. _MIT License:        https://opensource.org/licenses/MIT

.. |Packagist|  image:: https://img.shields.io/packagist/v/arokettu/datetime-rounding.svg?style=flat-square
   :target:     https://packagist.org/packages/arokettu/datetime-rounding
.. |GitHub|     image:: https://img.shields.io/badge/get%20on-GitHub-informational.svg?style=flat-square&logo=github
   :target:     https://github.com/arokettu/datetime-rounding
.. |GitLab|     image:: https://img.shields.io/badge/get%20on-GitLab-informational.svg?style=flat-square&logo=gitlab
   :target:     https://gitlab.com/sandfox/datetime-rounding
.. |Codeberg|   image:: https://img.shields.io/badge/get%20on-Codeberg-informational.svg?style=flat-square&logo=codeberg
   :target:     https://codeberg.org/sandfox/php-json
.. |Gitea|      image:: https://img.shields.io/badge/get%20on-Gitea-informational.svg?style=flat-square&logo=gitea
   :target:     https://sandfox.org/sandfox/datetime-rounding
