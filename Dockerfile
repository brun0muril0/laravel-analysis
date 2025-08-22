FROM bitnami/laravel:10

EXPOSE 3000

WORKDIR /app

COPY . .

RUN sudo composer install

RUN touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache database \
    && chmod -R 775 storage bootstrap/cache database

RUN php artisan key:generate

RUN php artisan migrate --force \
    && php artisan db:seed --class=DataSeeder --force

CMD [ "sudo","php", "-S", "0.0.0.0:3000", "-t","public" ]
