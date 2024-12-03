FROM nginx:1.23

ENV TZ=Asia/Tokyo

COPY ./*.conf /etc/nginx/conf.d/
ADD ./localhost.pem /etc/certs/localhost.pem
ADD ./localhost-key.pem /etc/certs/localhost-key.pem