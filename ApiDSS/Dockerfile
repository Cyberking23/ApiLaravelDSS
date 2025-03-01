FROM ubuntu/apache2

RUN apt update -y && apt upgrade -y
RUN apt install php php-fpm php-cli php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-bcmath openssl php-json php-tokenizer composer -y

RUN rm /etc/apache2/sites-available/000-default.conf
RUN rm /etc/apache2/sites-enabled/000-default.conf

COPY ./container_configs/000-default.conf /etc/apache2/sites-available
RUN ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/api

COPY . .

RUN chown -R www-data:www-data storage/ bootstrap/cache public/
RUN chmod -R 755 storage/ bootstrap/cache public/

RUN a2enmod rewrite
RUN composer install

EXPOSE 80
CMD [ "bash", "start.sh" ]