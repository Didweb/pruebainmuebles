# Prueba

---

### Requerimientos:

#### REST API sin autenticación
Tenemos una aplicación para gestionar tours virtuales. Las agencias inmobiliarias que
gestionan pisos en alquiler quieren hacer un tour virtual cada vez que el inmueble cambia de
inquilinos para llevar la trazabilidad visual del estado de ese inmueble en cada transacción.

La tarea consiste en implementar una REST API que sea capaz de dar de alta y modificar
inmuebles y los tours virtuales asociados al inmueble.

Los endpoints son los siguientes:


Añadir inmueble  `/api/property/add`

Modificar inmueble  `/api/property/update`

Añadir tour virtual  `/api/tour/add`

Modificar tour  `/api/tour/update`


Las dos entidades tienen estas propiedades...

**Inmueble**

- Id: identificador único del inmueble
- Título: string
- Descripción: string
- Tours: colección de objetos tours

**Tour**

- Id: identificador único del tour
- Inmueble: objeto inmueble al que pertenece
- Activo: boolean indicando si el tour està activado o desactivado

---
---
## Info del proceso y creación de la prueba:

### Entorno desarrollo

**Docker** con 3 servicios:
- nginx
- php
- mysql

**IDE**: PHPStorm

**SO**: Linux (Debian)

---

### Aplicación

- Symfony 5
- PHP 7.4
- Path doc api: `http://localhost:8080/api/doc`

Documentación API mediante: **Nelmio**

---

### Testing

#### Psalm
Run Psalm: `./vendor/bin/psalm` 

#### Phpunit
Run Phpunit: `./vendor/bin/phpunit`