# FASE DE CODIFICACIÓN E PROBAS

- [FASE DE CODIFICACIÓN E PROBAS](#fase-de-codificación-e-probas)
  - [1- Codificación](#1--codificación)
  - [2- Prototipos](#2--prototipos)
  - [3- Innovación](#3--innovación)
  - [4- Probas](#4--probas)

> Este documento explica como se debe realizar a fase de codificación e probas.

## 1- Codificación

> Crea unha carpeta no teu repositorio e sube o código frecuentemente.
>
> Mentres se vai codificando a aplicación, iranse atopando problemas e haberá que ir modificando aspectos do deseño. Estes cambios tamén se deben recoller na documentación.

## 2- Prototipos

Prototipo en FIGMA https://www.figma.com/design/y4H8Sfw6a6Vo7keHFK3eq8/ElTablonDigital?node-id=0-1&t=nioOfL72xUUqnobS-1


> A mellor opción é empregar Figma xa que esta é unha ferramenta en línea colavorativa. 
> **Comparte o prototipo cos profesores por medio de Figma ou descarga o arquivo local o cal subirás o teu repositorio de GitHub**.
> **Este prototipos deberían estar listo e enviados o titor para revisalo na primeira semana desta fase.**

## 3- Innovación

No caso de utilizar tecnoloxías diferentes ás estudadas no ciclo formativo, fai unha descrición dos retos asumidos e como se resolveron.

## 4- Probas

Deben describirse as probas realizadas e conclusión obtidas. Describir os problemas atopados e como foron solucionados.

Probas realizadas:
  Registro de usuario Particular
  Registro de usuario Empresa
  Registro con datos vacios
  Registro con usuario xa creado
  Registro con email xa usado

  Problemas:

    -Problema: Permitia crear usuarios con email identicos.
    -Solucion: na tabla da bd unique o email.

    -Problema: No guardaba os datos de empresa.
    -Solucion: modificar o sql de creación de usuario.

  Probas realizadas:
    -Publicar Anuncio

   Problemas:

    -Problema: Non se gardaban as categorias, localidades e tipo de anuncio
    -Solucion: modificar o sql de publicacion de auncio.

Probas realizadas:
  - Update de información de Usuario particular.
  - Update de informacicón de Usuario empresa.
  - Update de información de Anuncio.
  - Update imagen de Anuncio.

  Problemas:

    -Problema: Non actualizaban os datos da empresa.
    -Solucion: modificar o sql de actualización do usuario.

    -Problema: A imaxen se actualizaba sempre, sen pasarlle unha imaxe.
    -Solucion: meter na comprobacion de se existe imaxe esto : && $_FILES['imagen']['error'] === UPLOAD_ERR_OK, que por defecto el $_Filles['imagen'] sempre da true.

Probas realizadas:
  - Eliminacion Usuario.
  - Eliminacion Anuncio.

    -Problema: Permitia eliminar o anuncio si de calquer usuario
    -Solucion: Comprobar se o anuncio pertence a ese usuario antes de poder eliminalo

Conclusiones:
    Despois de estas probas na propia paxina as funcions estan solucionadas.
    Non hai problemas na creacion de usuarios e anuncios.

[**<-Anterior**](../README.md)
