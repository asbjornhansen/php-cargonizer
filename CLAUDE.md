# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

PHP SDK for the Cargonizer API by Logistra. This is a library package that provides object-oriented wrappers for interacting with Cargonizer's XML-based shipping and logistics API.

## Development Commands

### Dependencies
```bash
composer install
```

### Testing
```bash
# Run all tests (linting + PHPUnit)
composer test

# Run PHPUnit tests only
vendor/bin/phpunit

# Run linting only
vendor/bin/parallel-lint . --exclude vendor
```

### Examples
The `examples/` directory contains working examples. After installation, composer automatically creates `examples/config.yml` with empty configuration. Fill in credentials to run examples:
- `endpoint`: Use `Config::SANDBOX` or `Config::PRODUCTION` constants
- `secret`: Your Cargonizer API secret key
- `sender`: Your sender ID

## Architecture

### Service Layer Pattern
The SDK uses an abstract `Client` base class (src/zaporylie/Cargonizer/Client.php) that handles:
- HTTP client initialization via HTTPlug discovery
- Request building with authentication headers (`X-Cargonizer-Key`, `X-Cargonizer-Sender`)
- XML response parsing
- Error handling and exception wrapping

Concrete service classes extend `Client` and define:
- `$resource`: API endpoint path
- `$method`: HTTP method (GET, POST, etc.)
- Public methods that call `$this->request()` and return typed Data models

Examples: `Consignment`, `Agreements`, `Partners`, `Estimation`, `Profile`

### Data Models
All data models in `src/zaporylie/Cargonizer/Data/` implement `SerializableDataInterface`:
- `toXML(\SimpleXMLElement $xml)`: Serialize object to XML for API requests
- `static fromXML(\SimpleXMLElement $xml)`: Deserialize XML responses to objects

Collections use wrapper classes (e.g., `Consignments`, `Items`, `TransportAgreements`) that manage arrays of their respective types.

### Configuration
`Config` is a static singleton class that stores:
- `endpoint`: API base URL (sandbox vs production)
- `sender`: Sender identifier
- `secret`: API authentication key

Set via `Config::set($key, $value)` before making API calls.

### HTTP Client Abstraction
Uses HTTPlug (`php-http/httplug`) for HTTP client abstraction, allowing consumers to use any PSR-18 compatible HTTP client. Discovery automatically finds available implementations (e.g., Guzzle).

## Important Notes

- API communication is XML-based, not JSON
- Partner numbers should be treated as strings (see recent PR #19)
- The Cargonizer API uses custom `X-Cargonizer-*` headers for authentication
- Supports PHP 7.3 through 8.2
