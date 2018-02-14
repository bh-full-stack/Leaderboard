FROM ubuntu:latest

ARG API_HOST

ENV API_HOST ${API_HOST}

RUN apt-get update -y && apt-get install software-properties-common -y

RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php -y && apt-get update -y && \
    apt-get install -y git nginx php7.2-fpm php7.2-mysql php7.2-mbstring \
    php7.2-xml php7.2-zip php7.2-imagick curl

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

EXPOSE 80

ADD ./etc /etc

RUN ln -s /etc/nginx/sites-available/leaderboard /etc/nginx/sites-enabled/leaderboard

RUN sed -i -e "s/server_name \[servername\];/server_name ${API_HOST};/g" /etc/nginx/sites-available/leaderboard

ADD entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT /usr/local/bin/entrypoint.sh