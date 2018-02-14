FROM node

ARG APP_HOST

ENV APP_HOST ${APP_HOST}

ARG APP_ENV

ENV APP_ENV ${APP_ENV}

ARG API_HOST

ENV API_HOST ${API_HOST}

ARG API_OUTER_PORT

ENV API_OUTER_PORT ${API_OUTER_PORT}

RUN apt-get update -y && apt-get install -y apt-transport-https && \
    apt-get install -y curl nginx

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -

RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update -y && apt-get install -y yarn

ADD entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html

ADD ./etc /etc

RUN ln -s /etc/nginx/sites-available/leaderboard /etc/nginx/sites-enabled/leaderboard

RUN sed -i -e "s/server_name \[servername\];/server_name ${APP_HOST};/g" /etc/nginx/sites-available/leaderboard

EXPOSE 80

RUN yarn global add @angular/cli


ENTRYPOINT /usr/local/bin/entrypoint.sh