# Usa la imagen de PHP con Apache
FROM php:apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

# Copia los archivos HTML y PHP al directorio de trabajo de Apache
COPY . /var/www/html/

# Expone el puerto 80 para que pueda ser accedido desde fuera del contenedor
EXPOSE 80

CMD ["sh", "-c", "sleep 10 && apache2-foreground"]