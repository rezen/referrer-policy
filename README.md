# referrer-policy
Reading the docs on `referrer-policy` just isn't the same as interacting with it and the various options. This demo lets you see what actually gets leaked depending on the policy you use.

```sh
# Update /etc/hosts adding local.refer,dev.localhost 
# to point to 127.0.0.1
sudo ./bin/update_etc.sh

# Serve up application 
# ... with docker ...
docker-compose up

# ... or local php
php -S 0.0.0.0:8888

# Now go to http://localhost:8888 in your browser
```

### Links
- https://googlechrome.github.io/samples/fetch-api/fetch-referrer-policy.html
- https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Referrer-Policy