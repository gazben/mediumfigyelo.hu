#!/bin/bash

echo '* * * * * www-data cd /var/www/html/ && php artisan schedule:run >> /dev/null 2>&1' > /etc/cron.d/laravel

cp ./build/vhost.conf /etc/apache2/sites-available/000-default.conf

chown -R www-data:www-data /var/www/html/storage
sudo -u www-data rm /var/www/html/public/storage || true
sudo -u www-data php artisan storage:link

# update database
sudo -u www-data php artisan migrate --seed --force

# cache configs
# sudo -u www-data php artisan optimize
# sudo -u www-data php artisan api:cache

# Apache gets grumpy about PID files pre-existing
rm -f /var/run/apache2/apache2.pid

supervisord -n -c /var/www/html/build/supervisord.conf
