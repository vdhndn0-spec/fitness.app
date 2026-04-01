FROM php:8.2-apache

RUN a2enmod rewrite

RUN a2dismod mpm_event || true \
  && a2dismod mpm_worker || true \
  && a2enmod mpm_prefork

RUN docker-php-ext-install mysqli

WORKDIR /var/www/html
COPY . /var/www/html

ENV APACHE_DOCUMENT_ROOT=/var/www/html/site/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN sed -ri -e 's/AllowOverride\s+None/AllowOverride All/g' /etc/apache2/apache2.conf

COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8080
CMD ["/start.sh"]
