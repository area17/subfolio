# syntax = docker/dockerfile:1.3

# ---
# 1. Use latest known compatible version of PHP
FROM php:5.6.40-apache AS base

# ---
# 2. Upgrade system and installed dependencies for security patches
#
# Also enable to keep copies of downloaded packages for faster rebuilds
RUN --mount=type=cache,target=/var/cache/apt \
    --mount=type=cache,target=/var/lib/apt \
    --mount=type=tmpfs,target=/var/log \
    set -eux; \
    apt-get update; \
    apt-get upgrade -y

# ---
# 3. Install PHP extensions and tweak configuration
#
# ---
RUN --mount=type=cache,target=/var/cache/apt \
    --mount=type=cache,target=/var/lib/apt \
    --mount=type=tmpfs,target=/var/log \
    set -eux; \
    # ---
    # Configure PHP in production mode
    cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"; \
    # ---
    # Use `docker-php-ext-install` to ease installation of PHP
    # extensions
    #
    # Ref: https://github.com/mlocati/docker-php-extension-installer
    export \
      PHP_EXT_INSTALLER_VERSION=1.4.21 \
      PHP_EXT_INSTALLER_SHA256SUM=7b3237db9be786478ea46ab46e2b911df644d2c02dc7371b320235edc5f0fec3 \
    ; \
    cd /tmp; \
    { \
      curl --fail -Lo install-php-extensions \
        https://github.com/mlocati/docker-php-extension-installer/releases/download/${PHP_EXT_INSTALLER_VERSION}/install-php-extensions; \
      echo "${PHP_EXT_INSTALLER_SHA256SUM} *install-php-extensions" | sha256sum -c - >/dev/null 2>&1; \
      chmod +x install-php-extensions; \
    }; \
    # ---
    # Install common PHP extensions
    #
    # (no need to install mbstring, pdo, tokenizer or xml as they are already part of base image)
    ./install-php-extensions \
      exif \
      gd \
      zip \
    ; \
    # remove PHP extension installer
    rm -f ./install-php-extensions

# ---
# 4. Enable Apache modules
#
RUN --mount=type=cache,target=/var/cache/apt \
    --mount=type=cache,target=/var/lib/apt \
    --mount=type=tmpfs,target=/var/log \
    set -eux; \
    # ---
    a2enmod headers rewrite

# ---
# 5. Copy configuration and application code, adjusting permissions
#
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY --chown=www-data:www-data . /var/www/html
