#!/bin/sh

echo 'Installing composer'
./bin/composer-install.sh
COMPOSER_INSTALL_RESULT=$?

if [ $COMPOSER_INSTALL_RESULT -gt 0 ]
then
  echo "Composer not installed ($COMPOSER_INSTALL_RESULT). Try doing it manually."
  exit $COMPOSER_INSTALL_RESULT
fi

mv composer.phar composer
chmod +x composer

echo 'Installing project composer dependencies'
./composer install
