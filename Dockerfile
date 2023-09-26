FROM chialab/php-dev:8.2-apache

# install core dependencies
RUN apt update && apt install -y curl

# install nodejs
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt install -y nodejs

# install pcntl
RUN install-php-extensions pcntl
