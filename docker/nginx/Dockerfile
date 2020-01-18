FROM nginx:1.12-alpine

RUN mv /etc/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf.src
COPY ./vhost.conf /etc/nginx/conf.d/vhost.conf