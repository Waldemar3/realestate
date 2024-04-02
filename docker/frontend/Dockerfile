FROM node:latest

RUN apt-get update && apt-get install -y \
    vim \
    zip \
    unzip \
    curl

RUN npm install -g @vue/cli

EXPOSE 8080

CMD ["sh", "-c", "npm install && npm run serve --public 0.0.0.0:8080"]