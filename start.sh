docker-compose -f docker-compose.yml down && \
docker-compose -f docker-compose.yml build --force-rm --no-cache && \
docker-compose -f docker-compose.yml up --force-recreate