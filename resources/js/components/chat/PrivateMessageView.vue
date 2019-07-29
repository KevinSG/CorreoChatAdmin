<template>
  <div class="container">
    <section class="header">
      <h1 class="page-title">Mesajes privados - <small>Detalles del mensaje</small></h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-2 col-sm-2 col-with-right-border">
          <private-message-sidebar></private-message-sidebar>
        </div>

        <div class="col-sm-8">
          <h3>{{pmStore.message.data.subject}}</h3>
          <p>From: {{pmStore.message.data.sender.email}} <span class="pull-right">{{pmStore.message.data.sender.created_at}}</span></p>
          <div class="message">
            {{pmStore.message.data.message}}
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>

  import {mapState} from 'vuex'

  export default {
    props: {
        id: {required: true}
    },
    created () {
      this.$store.dispatch('getPrivateMessageById',this.id)
    },
    computed: {
      ...mapState({
        pmStore: state => state.PrivateMessageStore
      })
    },
    destroyed () {
      this.$store.dispatch('clearMessageView')
    }
  }
</script>
