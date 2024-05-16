FROM event-sourcing-symfony-poc/php

WORKDIR /var/www/html

ENV APP_ENV=dev

EXPOSE 80

CMD ["/var/www/html/bin/rr", "serve", "-c", ".rr.yaml", "--debug"]