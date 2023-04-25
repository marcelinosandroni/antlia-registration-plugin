# Using wordpress with php 7.4 for the plugin
FROM wordpress:5.8-php7.4-apache

# Set the working directory to the plugin folder
WORKDIR /var/www/html/wp-content/plugins/antlia-registration

# Copy the plugin files to the container
COPY . .

# Install dependencies (curl, composer, php dependencies)
RUN apt-get update && apt-get install -y curl \
    && curl -sS https://getcomposer.org/installer | php \
    && php composer.phar install --no-dev \
    && apt-get remove -y curl \
    && rm -rf /var/lib/apt/lists/*

# Set the plugin permissions
RUN chown -R www-data:www-data /var/www/html/wp-content/plugins/antlia-registration

# Set the container timezone to UTC
ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Back to default wordpress working directory
WORKDIR /var/www/html
