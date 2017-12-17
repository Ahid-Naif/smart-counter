<?php

Artisan::command('init-setup', function () {
    shell_exec("php artisan migrate:refresh && php artisan voyager:install && php artisan db:seed");
})->describe('Refresh everything and start from scratch.');
