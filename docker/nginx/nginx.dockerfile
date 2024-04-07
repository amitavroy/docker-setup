FROM nginx:stable-alpine3.17-slim

ADD ./default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/www/html
