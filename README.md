# Estated API - PHP SDK

## Installation

Install via composer as follows:
```
composer require force/estated-api-sdk
```

## Usage

### Authentication

Estated client relies on the `api_key` returned by auth request to
access the API.

```php
$estatedClient = new \ForwardForce\Estated\Estated($token);
```

### Get general data by address

```php
$estatedClient->generalData('151 Battle Green Dr', 'Rochester', 'NY', '14624');
```

## Contributions

To run locally, you can use the docker container provided here. You can run it like so:

```
docker-compose up
```
There is auto-generated documentation as to how to run this library on local, please  take a look at [phpdocker/README.md](phpdocker/README.md)

*If you find an issue, have a question, or a suggestion, please don't hesitate to open a github issue.*

### Acknowledgments

Thank you to [phpdocker.io](https://phpdocker.io) for making getting PHP environments effortless! 
