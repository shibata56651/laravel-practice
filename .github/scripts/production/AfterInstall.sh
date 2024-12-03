SERVER_DIR=/var/www/tantei/server/

chown -R nginx:nginx $SERVER_DIR

chmod -R 777 $SERVER_DIR/storage
chmod -R 777 $SERVER_DIR/bootstrap/cache