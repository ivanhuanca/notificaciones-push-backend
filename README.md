# Laravel API Starter

Este proyecto está configurado para funcionar solo como API REST.

## Instalación

1. Instala dependencias:
	```bash
	composer install
	```
2. Copia `.env.example` a `.env` y configura tu base de datos.
3. Genera la clave de la aplicación:
	```bash
	php artisan key:generate
	```

## Autenticación

- Usa Laravel Sanctum para autenticación de APIs.
- Configura CORS en `config/cors.php` según tus necesidades.

## Middleware

- El middleware `ForceJsonResponse` fuerza todas las respuestas a formato JSON.

## Ejecutar servidor

```bash
php artisan serve
```

## Notas
- No incluye vistas ni Blade.
- Solo rutas API en `routes/api.php`.

---

Para agregar endpoints, edita `routes/api.php` y los controladores en `app/Http/Controllers`.
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
