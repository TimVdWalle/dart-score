#!/bin/bash

set -e
cd /home/beta-51f0q/beta.dartscore.be

git add .
git commit -m "Resolved merge conflicts."
git push origin develop


git pull origin develop
#php artisan migrate:fresh
#composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
composer update
npm install && npm run build
php artisan migrate --force

echo "" | sudo -S service php8.2-fpm reload
echo "🚀 Application deployed!"