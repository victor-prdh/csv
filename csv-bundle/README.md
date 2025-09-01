Simple bundle to read CSV

Can be launched with:
```shell
bin/console csv-bundle:show-info ./file/path.csv
```

You want a json instead, try:
Can be launched with:
```shell
bin/console csv-bundle:show-info ./file/path.csv --json
```

With Symfony Scheduler, an auto-launch every day from 7am to 7pm is auto-scheduled

```shell
composer require symfony/messenger symfony/scheduler dragonmantank/cron-expression
bin/console debug:scheduler
```

To use this in prod, check: https://symfony.com/doc/current/messenger.html#deploying-to-production

Else, you can always use crontab:
```shell
0 7-19 * * * /var/www/xxxxxxx/bin/console csv-bundle:show-info /file/path.csv --json
```