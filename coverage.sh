#!/bin/bash

echo "##### Executando os testes com coverage #####"
docker exec jefffrade-teste-winx-php-fpm vendor/bin/phpunit --coverage-html coverage/

echo "Arquivos gerados em coverage/"
