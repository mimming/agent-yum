#!/bin/sh
rsync -vaz ./* --exclude ./config.php mimming.com:~/mimming.com/mirror-quickstart-php/
rsync -vaz ./config.php_mimmingcom mimming.com:~/mimming.com/mirror-quickstart-php/config.php
