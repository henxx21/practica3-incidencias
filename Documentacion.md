# Práctica 3 – Gestión de Incidencias
## Este proyecto consiste en una aplicación web para la gestión de incidencias asociadas a técnicos.

La aplicación está desarrollada con: PHP (con php-fpm), MariaDB, Nginx, Contenedores Podman, HTML + Bootstrap, PDO para la comunicación con la base de datos

Se trata de una relacion de uno a muchos. Un técnico puede tener muchas incidencias porque cada incidencia pertenece exactamente a un técnico.

TABLAS UTILIZADAS: tecnico, incidencia

La foreing key es: incidencia.id_tecnico → tecnico.id_tecnico -> es decir, a la tabla incidencia se le va a asociar el id de cada tecnico de la tabla tecnicos para crear la relación.

El proyecto está desplegado en aws en una máquina EC2 en el learner lab, para poder acceder a la aplicación es necesario:

* 1._ ACCEDER A EC2 EN AWS Y ARRANCAR LA INSTANCIA LLAMADA "UBUNTU"
* 2._ SELECCIONAR LA INSTANCIA Y DARLE A CONECTAR, Y CONECTARSE A LA TERMINAL
* 3._ UNA VEZ DENTRO, HACER UN "ls" Y ACCEDER A LA CARPETA "practica3-incidencias" UNA VEZ DENTRO EJECUTAR EL COMANDO: "podman-compose up -d", ES IMPORTANTE ESTAR EN LA CARPETA PORQUE ES AHÍ DONDE ESTÁ EL ARCHIVO PODMAN-COMPOSE QUE ES EL QUE LEVANTA LOS CONTENEDORES NECESARIOS PARA QUE FUNCIONE LA APLICACION
* 4._ TRAS ELLO LA PODEMOS ACCEDER DESDE EL NAVEGADOR PONIENDO EN LA URL LA IP ASIGNADA A LA INSTANCIA MAS EL PUERTO Y EL ARCHIVO DE LOGIN
* 5._ EJEMPLO SERIA: h ttp://54.162.255.21:8080/login.php
