FROM  python:3.9-slim

RUN apt-get update && apt-get install -y iputils-ping

WORKDIR /opt/api

COPY . .

RUN pip install -r requirements.txt
