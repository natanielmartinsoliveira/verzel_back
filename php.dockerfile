FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
    
    #RUN pecl bundle redis \
    ## && docker-php-ext-configure redis --enable-redis-igbinary \
    #  && docker-php-ext-install -j${nproc} redis
    #&& docker-php-ext-enable redis

    #RUN pecl install --force redis 
    #&& rm -rf /tmp/pear \
    #&& docker-php-ext-enable redis
    
    RUN pecl install --force xdebug; \
    docker-php-ext-enable xdebug; 

    #RUN pecl install --force redis \
    #	&& pecl install --force xdebug \
    #	&& docker-php-ext-enable redis xdebug

RUN apt-get update && apt-get install -y libmemcached-dev libssl-dev zlib1g-dev 

RUN apt-get update && apt-get upgrade -y && apt-get install -y git

RUN set -ex \
    && apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y libmemcached-dev \
    && rm -rf /var/lib/apt/lists/* \
    && MEMCACHED="`mktemp -d`" \
    && curl -skL https://github.com/php-memcached-dev/php-memcached/archive/master.tar.gz | tar zxf - --strip-components 1 -C $MEMCACHED \
    && docker-php-ext-configure $MEMCACHED \
    && docker-php-ext-install $MEMCACHED \
    && rm -rf $MEMCACHED


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo 'date.timezone="America/Sao_Paulo"' >> /usr/local/etc/php/conf.d/date.ini \
    && echo 'opcache.enable=1' >> /usr/local/etc/php/conf.d/opcache.conf \
    && echo 'opcache.validate_timestamps=1' >> /usr/local/etc/php/conf.d/opcache.conf \
    && echo 'opcache.fast_shutdown=1' >> /usr/local/etc/php/conf.d/opcache

#ADD . /var/www/projects
#RUN chown -R www-data:www-data /var/www/projects
##RUN chmod 777 -R ./var/www/projects


# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

#WORKDIR /var/www/projects
#COPY ./start_server.sh /var/www/projects
##COPY /var/www/projects/aluga-carros/.env.build /var/www/projects/aluga-carros/.env
##COPY --chown=www:www . /start_server.sh
# Copy existing application directory permissions
COPY --chown=www:www . /var/www/projects
COPY --chown=www:www . /var/www/projects/aluga-carros/storage
COPY --chown=www:www . /var/www/projects/aluga-carros/storage/logs
COPY --chown=www:www . /var/www/projects/aluga-carros/vendor/composer

RUN chown -R www:www /var/www/projects/aluga-carros/storage/logs
RUN chown 777 -R /var/www/projects/aluga-carros/vendor/
RUN chown 777 -R /var/www/projects/aluga-carros/vendor/composer
# Change current user to www
RUN chmod -R 777 /var/www/projects/aluga-carros/
#RUN chown 777 /var/www/projects/aluga-carros/vendor/composer/autoload_psr4.php  
USER www

##WORKDIR /var/www/projects/aluga-carros
##CMD bash -c "php artisan migrate "
##COPY ./.env /var/www/projects/aluga-carros/.env
#ENTRYPOINT ["./start_server.sh"]

##ENTRYPOINT ["/bin/bash","/start_server.sh"]
#ENTRYPOINT ["./start_server.sh"]
#CMD ["php-server-serving-api"]