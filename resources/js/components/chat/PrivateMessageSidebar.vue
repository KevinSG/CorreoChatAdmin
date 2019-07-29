
<template>
  <ul >
    <li><a href="/enviar">Enviar</a></li>
    <li><a href="/index">Recibidos</a></li>
    <li><a href="/enviados">Enviados</a></li>
  </ul>
</template>
<script>
  export default {

  }
</script>
<style>
.pointer {
  cursor: pointer;
}
 a.href-active {
  color: #333333;
  background-color: transparent;
}
li>a.href {
  color: #fff;
  background-color: #337ab7;
}
.col-with-right-border {
  border-right: 1px solid $border-color;
}
</style>
