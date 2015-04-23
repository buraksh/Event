## Very simple event dispatcher class

  ```php
  use Burax\Event;

  Event::on('event name', function () {
      // ...
  }, $priority);

  Event::trigger('event name');
  ```

## Installation

To install the package through [Composer](http://getcomposer.org) edit `composer.json` and add lines below.

  ```php
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/buraksh/Event"
        }
    ],
    "require": {
        "burax/event": "dev-master"
    }
  ```

Then run the following command from command line:

  ```bash
  php composer.phar update
  ```