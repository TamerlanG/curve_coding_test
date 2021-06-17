# Exchange Rate API

An API that provides information about exchange rates.

## What was used?
- PHP 7.4
- Laravel Lumen
- Docker + Docker-Compose
- Nginx
- [Third Party Exchange Rates API](https://exchangeratesapi.io/)

## IMPORTANT NOTE
Due to the limitations on the third-party API, I was couldn't change the base currency, and didn't have access to the historical_data API. So I had to recursively fetch data for every date. This is why the recommendation API is pretty slow.

The base currency for the rate API is GBP, and for recommendations API is EURO.

## Prerequisites
Just make sure to have docker and docker-compose installed, and running.
## Services

There are three services:
- API Gateway
- Rate
- Recommendation

## Installation
1. Clone repo then run the following commands to run the containers
```bash
cd api_gateway && make run && cd ..
cd rate && make run && cd ..
cd recommendation && make run && cd ..
```
Make sure to configure the .env files with the appropriate keys and settings.

## API
There are two APIS:
1. localhost/api/rate
2. localhost/api/recommend

They are both **POST** requests and only **REQUIRE** there to be a body with the field named "**quote**" that is basically a string of currencies, ex. "USD, EUR, KZT" 