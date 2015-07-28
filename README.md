# SITe Wordpress Plugin

## For developers

### Setup

```bash
docker-compose up
docker-compose run db mysql -h sitewordpress_db_1 -pexample wordpress < db.sql
```

Now visit [http://localhost:8080/](http://localhost:8080/) on Linux or
[http://dockerhost:8080/](http://dockerhost:8080/) on Mac

You can login as the user "admin" with password "admin".
