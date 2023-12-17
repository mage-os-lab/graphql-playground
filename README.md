# Mage-OS GraphQl Playground

This module is a playground for GraphQl queries and mutations. It is not intended for production use.

The module bundles the graphiql tool which is licensed under the MIT license. See [graphiql/LICENSE](graphiql/LICENSE) for more information.

---

## Installation

1. Install it into your Mage-OS/Magento 2 project with composer:
    ```
    composer require mageos/graphql-playground
    ```

2. Enable module
    ```
    bin/magento setup:upgrade
    ```

## Configuration

The GraphQL playground is automatically available in developer mode.
In the production mode it is disabled by default. To enable it in production mode, run:

```bash
bin/magento config:set --lock-env dev/graphiql/enabled_in_production 1
```
 
In the developer mode the configuration can be set in the adminhtml configuration under `Stores > Configuration > Advanced > Developer > GraphQL Playground`.

## Usage

Open the GraphQL playground in your browser: `https://<your-base-url>/graphiql`


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Testing

### Unit Tests

In the command line, change into the module directory and run:

```
composer install
./vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
