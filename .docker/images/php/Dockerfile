FROM php:8.2-cli-bullseye as base

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update -y && apt-get install -y --no-install-recommends \
    curl \
    wget \
    zip \
    unzip \
    git \
    procps \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libssh-dev \
    libpcre3 \
    libpcre3-dev \
    libnghttp2-dev \
    libhiredis-dev \
    nano \
    libzip-dev \
    icu-devtools \
    zlib1g-dev \
    libgmp3-dev \
    libicu-dev \
    libxml2-dev \
    g++ \
    inotify-tools \
    libonig-dev \
    libwebp-dev \
    libxpm-dev \
    libbz2-dev \
    libgd-dev \
    libc-client-dev \
    libkrb5-dev \
    libldb-dev \
    libldap2-dev \
    libreadline-dev \
    libxslt-dev \
    unixodbc-dev \
    libmemcached-dev \
    libsnmp-dev \
    freetds-bin \
    freetds-dev \
    freetds-common \
    snmp \
    libpspell-dev \
    aspell-en \
    libpq-dev \
    libtidy-dev \
    librabbitmq-dev \
    imagemagick \
    libmagickwand-dev \
    ghostscript \
    libvips42 && \
    libmongoc-dev && \
    wget https://get.symfony.com/cli/installer -O - | bash && \
    mv /root/.symfony5/bin/symfony /usr/local/bin/symfony && \
    wget https://github.com/FriendsOfPHP/pickle/releases/latest/download/pickle.phar && \
    mv pickle.phar /usr/local/bin/pickle && \
    chmod +x /usr/local/bin/pickle && \
    ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h && \
    ln -s /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/libldap.so && \
    ln -s /usr/lib/x86_64-linux-gnu/liblber.so /usr/lib/liblber.so && \
    ln -s /usr/lib/x86_64-linux-gnu/libsybdb.a /usr/lib/libsybdb.a && \
    git clone https://github.com/Imagick/imagick && \
    cd imagick && \
    phpize && \
    ./configure && \
    make && \
    make install && \
    docker-php-ext-enable imagick && \
    cd .. && \
    rm -rf imagick && \
    docker-php-ext-configure gd \
    --with-webp \
    --with-jpeg \
    --with-xpm \
    --with-freetype && \
    docker-php-ext-configure intl && \
    docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
    docker-php-ext-install \
    mysqli \
    pdo_mysql \
    pdo_dblib \
    pdo_pgsql \
    pgsql \
    bz2 \
    gettext \
    gmp \
    pspell \
    ffi \
    shmop \
    sockets \
    gd \
    imap \
    ldap \
    soap \
    sysvmsg \
    sysvsem \
    sysvshm \
    xsl \
    zip \
    intl \
    pcntl \
    snmp \
    tidy \
    opcache && \
    docker-php-ext-enable opcache && \
    PICKLE_PECL_UNSAFE=1 pickle install inotify --defaults && docker-php-ext-enable inotify && \
    PICKLE_PECL_UNSAFE=1 pickle install igbinary --defaults && docker-php-ext-enable igbinary && \
    PICKLE_PECL_UNSAFE=1 pickle install msgpack --defaults && docker-php-ext-enable msgpack && \
    PICKLE_PECL_UNSAFE=1 pickle install redis --defaults && docker-php-ext-enable redis && \
    PICKLE_PECL_UNSAFE=1 pickle install amqp-2.1.1 --defaults && docker-php-ext-enable amqp && \
    PICKLE_PECL_UNSAFE=1 pickle install swoole --defaults --version-override 5.1.2 && docker-php-ext-enable swoole && \
    PICKLE_PECL_UNSAFE=1 pickle install mongodb --defaults --version-override 5.1.2 && docker-php-ext-enable mongodb && \
    curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    composer self-update --clean-backups && \
    cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
    mkdir -p /var/www/html && \
    docker-php-source delete && \
    apt-get autoremove -y && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    rm -rf /tmp/* && \
    apt-get purge -y --auto-remove && \
    rm -rf /tmp/pear && \
    rm -rf /tmp/src && \
    rm -rf tmp/pickle && \
    apt-get remove --purge -y libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libssh-dev \
    libpcre3-dev \
    libnghttp2-dev \
    libhiredis-dev \
    libzip-dev \
    icu-devtools \
    zlib1g-dev \
    libgmp3-dev \
    libicu-dev \
    libxml2-dev \
    libonig-dev \
    libwebp-dev \
    libxpm-dev \
    libbz2-dev \
    libgd-dev \
    libc-client-dev \
    libkrb5-dev \
    libldb-dev \
    libldap2-dev \
    libreadline-dev \
    libxslt-dev \
    unixodbc-dev \
    libmemcached-dev \
    libsnmp-dev \
    freetds-dev \
    libpspell-dev \
    libpq-dev \
    libtidy-dev \
    librabbitmq-dev \
    imagemagick \
    libmagickwand-dev \
    libmongoc-dev

FROM base as build

RUN apt-get update -y && apt-get install -y --no-install-recommends \
    libz-dev \
    cmake \
    unzip && \
    cd /tmp/ && \
    wget https://github.com/protocolbuffers/protobuf/releases/download/v25.1/protoc-25.1-linux-x86_64.zip && \
    unzip protoc-25.1-linux-x86_64.zip && \
    mv bin/protoc /usr/local/bin/protoc && \
    git clone -b v1.60.0 https://github.com/grpc/grpc && \
    cd grpc && \
    git submodule update --init && \
    mkdir -p cmake/build && \
    cd cmake/build && \
    cmake ../.. && \
    make protoc grpc_php_plugin

FROM base

COPY --from=build /tmp/grpc/cmake/build/third_party/protobuf/protoc /usr/local/bin/protoc
COPY --from=build /tmp/grpc/cmake/build/grpc_php_plugin /usr/local/bin/grpc_php_plugin

RUN apt-get update -y && apt-get install -y --no-install-recommends \
    libz-dev && \
    PICKLE_PECL_UNSAFE=1 pickle install grpc --defaults && docker-php-ext-enable grpc && \
    PICKLE_PECL_UNSAFE=1 pickle install protobuf --defaults && docker-php-ext-enable protobuf && \
    docker-php-source delete && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    rm -rf /tmp/*