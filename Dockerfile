FROM patriciatech/php:alpine


WORKDIR /var/www/

# Copy existing application directory contents
COPY . .

# Copy composer.lock and composer.json
COPY composer.json /var/www/

RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
    # --no-dev \
    --no-interaction \
    --no-scripts \
    --prefer-dist

RUN chown -R www-data:www-data /var/www/*

COPY apache/apache.conf /etc/apache2/sites-available/000-default.conf
COPY apache/ports.conf /etc/apache2/ports.conf
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Enable mod_rewrite
#RUN a2enmod rewrite

CMD bash -C './run.sh';'bash'
