
<template>
  <!-- <ul class="list-group">
    <li class="list-group-item"><a href="/enviar">Enviar</a></li>
    <li class="list-group-item"><a href="/index">Recibidos</a></li>
    <li class="list-group-item"><a href="/enviados">Enviados</a></li>
  </ul> -->
  <div class="col-3">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-inbox-list" data-toggle="list" href="#list-inbox" role="tab" aria-controls="inbox">Bandeja de entrada - ({{pmStore.subjectRecount}})</a>
      <a class="list-group-item list-group-item-action" id="list-enviados-list" data-toggle="list" href="#list-enviados" role="tab" aria-controls="enviados">Elementos enviados</a>
      <a class="list-group-item list-group-item-action" id="list-nuevo-list" data-toggle="list" href="#list-nuevo" role="tab" aria-controls="nuevo">Mensaje nuevo</a>
    </div>
  </div>
</template>
<script>
import {mapState} from 'vuex'

  export default {
    props: {
        user: {required: true}
    },
    data (){
      return {
        pru: null

      }
    },
    computed: {
      ...mapState({
        pmStore: state => state.PrivateMessageStore

      })
    },
    created () {
      this.$store.dispatch('setUserSubjectsRecount', this.user);
    },
    sockets: {
      message(data) {
        //console.log(data);
        let message = JSON.parse(data);
        this.$store.dispatch('newSubjectCountNotification', message.count);
      }
    }
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
