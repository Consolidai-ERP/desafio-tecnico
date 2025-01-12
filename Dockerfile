# Usando a imagem base do PHP com Apache
FROM php:8.2-apache

# Instalar extensões necessárias para o PHP (pdo e pdo_mysql)
RUN docker-php-ext-install pdo pdo_mysql

# Instalar o Composer (se não estiver copiando de outra imagem)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar os arquivos do projeto para o diretório de trabalho dentro do container
COPY ./src /var/www/html/

# Garantir as permissões corretas dos arquivos copiados
RUN chown -R www-data:www-data /var/www/html

# Alterar o arquivo de configuração do Apache para apontar para o diretório 'public' como raiz
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Ativar o módulo de reescrita do Apache
RUN a2enmod rewrite

# Definir o diretório de trabalho como /var/www/html
WORKDIR /var/www/html

# Expôr a porta 80 para acesso
EXPOSE 80

# Iniciar o Apache no modo foreground para o container rodar corretamente
CMD ["apache2-foreground"]
