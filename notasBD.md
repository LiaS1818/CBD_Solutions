# Ventas

## Listado de Entidades

- id
- nombre
- apellido
- email
- contrasena
- telefono
- nacimiento

### Direcciones Clientes

- id **(PK)**
- id_cliente **(FK)**
- direccion
- cp
- ciudad
- pais **(FK)**

### Productos **(ED|EC)**

- id **(PK)**
- nombre
- precio
- descripcion
- imagen

