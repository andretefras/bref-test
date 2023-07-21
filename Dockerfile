FROM node:latest as node
FROM php:8.2-cli

ARG USER
ARG PW
ARG UID
ARG GID
ARG AWS_KEY
ARG AWS_SECRET

RUN useradd -m ${USER} --uid=${UID} && echo "${USER}:${PW}" | \
      chpasswd

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions json

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node

RUN apt-get update && apt-get install -y git zip

RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm
RUN npm i -g serverless
RUN serverless config credentials --provider aws --key ${AWS_KEY} --secret ${AWS_SECRET}

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./ /usr/src/app

WORKDIR /usr/src/app

USER ${UID}:${GID}

ENTRYPOINT php -S 0.0.0.0:8080 index.php
