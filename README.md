# Wordup CMS

...

## Install the Application ##

```
$ git clone ... wordup
$ cd wordup
$ composer install
$ chgrp
```

Wordup CMS uses Vagrant for development to make installation simple. Please install Vagrant for this purpose. Otherwise, please refer to the /provision.sh script to understand dependencies required for other installations.

```
$ vagrant up
```

Add the following to /etc/hosts

```
192.168.33.11     wordup.vagrant
```

## Testing ##

```
$ vagrant ssh
$ cd /var/www/wordup/website
$ vendor/bin/phpunit tests/
```

When writing new tests, some custom controller assertions have been added:

```php
$this->assertQuery('form#register', (string)$response->getBody());
$this->assertQueryCount('ul.errors li', 3, (string)$response->getBody());
```

TODO

* create layout
* publish
* validation
* users
* focus in fields when they open
* BUG: elements (rename to fields) aren't saving
* write some seeds: e.g. content types - 6-6 Columns, 4-4-4 Columns, 12 Column, News article (listing, full-page), Event (listing, full-page)
* add indexes to migrations
* status of folders, content
* tinycme
* flash messages
* testing
