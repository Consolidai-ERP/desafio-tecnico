# Usar a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instalar extensões necessárias para o PHP e utilitários para debugging
RUN apt-get update && apt-get install -y nano curl \
    && docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

# Instalar o Composer e validar a instalação
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --quiet \
    && composer --version

# Configurar permissões do diretório do Apache e arquivos do projeto
COPY ./src /var/www/html/
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configurar o Apache para permitir .htaccess
RUN echo '<Directory /var/www/html>' > /etc/apache2/conf-available/override.conf \
    && echo '    AllowOverride All' >> /etc/apache2/conf-available/override.conf \
    && echo '    Require all granted' >> /etc/apache2/conf-available/override.conf \
    && echo '</Directory>' >> /etc/apache2/conf-available/override.conf \
    && a2enconf override \
    && apachectl configtest

# Definir o diretório de trabalho como /var/www/html
WORKDIR /var/www/html

# Expôr a porta 80 para acesso externo
EXPOSE 80

# Iniciar o Apache no modo foreground
CMD ["apache2-foreground"]
