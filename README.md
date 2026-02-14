# Notificaciones Push - Paso a Paso

## Implementación

1. **Migración de la tabla de suscripciones push**
   - Ejecuta las migraciones:
     ```bash
     php artisan migrate
     ```
   - Verifica que la tabla `push_subscriptions` esté creada en la base de datos.

2. **Configuración del frontend**
   - Compila los assets:
     ```bash
     npm run build
     ```
   - Suscríbete a notificaciones push desde la interfaz web.

3. **Endpoints API**
   - Guarda la suscripción push usando el endpoint:
     ```http
     POST /api/push/subscribe
     ```
   - Envía notificaciones usando:
     ```http
     POST /api/push/send
     ```

4. **Autenticación**
   - Usa Laravel Sanctum para proteger los endpoints de notificaciones.