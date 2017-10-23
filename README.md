# ntrk-carousel-cposts
Plugin de WordPress para construir carruseles animados y responsive. Cada carrusel dispone de un shortcode único para mostrarlo en cualquier página o entrada de WordPress.

# Instalación

## Requisitos previos
* Este plugin requiere tener instalado y activado [Piklist](https://piklist.com)

## Proceso de instalación
1. Descargar el contenido del repositorio en formato ZIP y descomprimir la carpeta 'ntrk-carousel-cposts' en la carpeta 'wp-content/plugins' de su instalación de WordPress.

2. Acceder al panel de administración de WordPress, identificándose con las credenciales correspondientes, y activar el plugin desde el menú de gestión de plugins.

# Manual de usuario

## Estructura de un carrusel
Puede crear cuantos carruseles desee.

* Cada carrusel estará formado por un número ilimitado de diapositivas.

* Cada diapositiva consta de una imagen y un campo de texto descriptivo.

## Crear un nuevo carrusel
* Al activar el plugin, se añadirá un nuevo menú de nombre "NETIREKI - Carousels" a la barra lateral del panel de administración de WordPress.

* Pinche sobre la opción "Add New" de este menú, y se le mostrará la pantalla de edición del Carrusel:

  - Title: de uso interno. Le servirá para identificar cada carrusel en el panel de gestión.
  - Carousel Settings:
    Opciones básicas de configuración del carrusel:
    - Infinite loop: marque esta casilla si desea que el carrusel continúe desplazándose tras mostrarse la última diapositiva del mismo. Valor por defecto: marcado.
    - Navigation dots: marque esta casilla si desea que bajo el carousel se muestren unos puntos que le sirvan de navegación entre las distintas diapositivas. Valor por defecto: marcado.
    - Slides to Show: número de diapositivas que se mostrarán al mismo tiempo dentro del carrusel. Valor por defecto: 3.
    - Slides to Scroll: número de diapositivas que se desplazarán en cada transición animada. Valor por defecto: 1.
  - Responsive Settings:
    Permiten definir valores específicos de las opciones básicas de configuración según el ancho de pantalla del dispositivo (breakpoint):
    - Breakpoint (px): valor numérico expresado en píxeles que marca la anchura máxima de pantalla hasta la que tendrán efecto los valores introducidos.
    - Slides to show: número de diapositivas que se mostrarán al mismo tiempo dentro del carrusel para anchos de pantalla menores o iguales que el valor introducido en el campo Breakpoint.
    - Slides to scroll: número de diapositivas que se desplazarán en cada transición animada para anchos de pantalla menores o iguales que el valor introducido en el campo Breakpoint.
  - Slides:
    Permite añadir un número ilimitado de diapositivas al carrusel:
    - Image: imagen vinculada a la diapositiva. Seleccionar una.
    - Slide Text: texto descriptivo vinculado a la diapositiva. Permite insertar etiquetas HTML para introducir enlaces u otros elementos.

## Insertar un carrusel en una página o entrada
Después de crear y publicar un carrusel, en la parte superior de la pantalla de edición de Carruseles se mostrará el código shortcode que deberá introducir en su página o entrada de WordPress.

Este código tendrá el siguiente formato: [ntrk-carousel-cposts id={ID}], donde {ID} será un valor numérico que permitirá identificar cada uno de los carruseles.
