#!/usr/bin/env bash

sed -i "s/apiEndPoint: '.*'/apiEndPoint: 'http:\/\/${API_HOST}:${API_OUTER_PORT}\/api\/'/g" ./src/environments/environment.ts

sed -i "s/storageEndPoint: '.*'/storageEndPoint: 'http:\/\/${API_HOST}:${API_OUTER_PORT}\/storage\/'/g" ./src/environments/environment.ts

yarn install
ng build --environment=dev --target=production

service nginx start
tail -f /var/log/nginx/error.log