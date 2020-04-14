# referrer-policy

```sh
# Update /etc/hosts adding local.refer,dev.localhost 
# to point to 127.0.0.1
sudo ./bin/update_etc.sh

# Serve up application 
# ... with docker ...
docker-compose up

# ... or local php
php -S 0.0.0.0:8888
```

### Links
- https://googlechrome.github.io/samples/fetch-api/fetch-referrer-policy.html