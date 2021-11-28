#!/bin/sh
cd .. /

# INITIALIZE CONTEINERS 
docker-compose up -d --build && 

#INSTALL DEPENDENCIES
docker exec -i maracas-api bash -c "cd /var/www/html && composer install" &&

# EXECUTE MIGRATIONS DATABASE
docker exec -i maracas-api bash -c "cd /var/www/html && php artisan migrate --seed" &&

# EXECUTE TESTS
docker exec -i maracas-api bash -c "cd /var/www/html && php artisan test --testsuite=Feature"

echo "Aplicação configurada."