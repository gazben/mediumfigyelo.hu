# Mediumfigyelő

This application fetches websites, saves their content and searches for keywords in them.

*Install*
```
composer install
npm ci
php artisan migrate --seed
```

*Scraping*
```
php artisan scrape:site
php artisan scrape:evaluate
```

## Example screenshot

![example screen](docs/screen.jpg)