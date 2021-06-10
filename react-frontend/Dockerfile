FROM node:slim

RUN npm install react-scripts --global --silent

WORKDIR /app

COPY . .

RUN yarn

RUN cp -rf /usr/local/lib/node_modules ./
