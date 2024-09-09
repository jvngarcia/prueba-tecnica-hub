# Prueba tecnica

## Objetivo

Crear un nuevo HUB que se encargará de solicitar información a los proveedores y de agregar los resultados en una respuesta única y consolidada. Este nuevo HUB tendrá solo un método, Search, que ejecutará el siguiente flujo:

1. Recibir una solicitud de búsqueda en un formato común (formato HUB).
2. Traducir la solicitud de búsqueda del HUB a múltiples solicitudes de búsqueda, una para
   cada proveedor. Todos los proveedores tienen un formato de búsqueda diferente.
3. Traducir cada respuesta de los proveedores (en un formato diferente para cada uno) a
   una respuesta en el formato del HUB.
4. Agregar las diferentes respuestas en una sola.

## Solución

1. Se implementó la arquitectura hexagonal para disminuir deuda tecnica y la capacidad de agregar a futuro nuevos proveedores sin afectar el código realizado.
2. Se aisló la implementación en una nueva carpeta "src" para no depender 100% del framework
3. Se tiene como punto de conexión entre en framework y la implementación el archivo `src/search/hub/infrastructure/HUBPostController.php`

## ¿Cómo ejecutar el proyecto?

-   Realizar git clone del proyecto
-   Copiar .env.example y pegar con nuevo nombre: .env
-   Cambiar las variables de entorno por las locales
-   Ingresar a la carpeta del proyecto
-   Usar consola de comandos y ejecutar: `composer install` y `npm install`
-   En una nueva consola: `npm run dev`
-   En otra consola: `php artisan serve`
-   Ingresar a: `http://127.0.0.1:8000/`

## ¿Cómo implementar un nuevo proveedor?

Debido a que cada proveedor puede poseer un diseño y arquitectura totalmente distinto, se creó la interfáz fundamental `IHUBRepository` que debe ser implementada en cada nuevo proveedor.

-   Se debe crear un nuevo archivo en la ruta `src/search/hub/infrastructure/` Siguiendo la nomenclatura `ProveedorRepository.php`

```php
<?php

namespace src\search\hub\infrastructure;

use src\search\hub\domain\IHUBRepository;

class ProveedorRepository implements IHUBRepository
{
  public function search(RequestHUB $request): ?Rooms
  {
    # your code
  }
}
```

-   Debido a la naturaleza de la interfaz, se debe retornar un valor null en caso de no encontrar datos y un objeto llamado `Rooms` en caso de haber datos.
-   Usar `src/search/hub/infrastructure/HotelLegsRepository.php` como ejemplo
-   Se debe importar el nombre de la clase creada en el archivo `src/search/hub/infrastructure/HUBPostController.php` en la variable `$repositories`

```php
private $repositories = [
  HotelLegsRepository::class,
  ProveedorRepository::class
];
```

-   Y listo, las nuevas búsquedas hacia el nuevo proveedor se incorporarán de manera automática a la respuesta del HUB.

## Puntos de mejora

-   Implementar test unitarios
-   Implementar test de integración
-   Tomar en cuenta que si se implementa un nuevo proveedor, y posee el mimo room id que otro, no se agrega a la información, sino que aparecen ambos

## Consumo de API

Revisar el link de postman para ejemplo de consumo y respuesta: [Click Acá](https://documenter.getpostman.com/view/18337636/2sAXjSyoKN)
