<template>
  <div class="container">
    <section class="header">
      <h1 class="page-title">Mesajes privados - <small>Enviar mensaje</small></h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-2 col-sm-2 col-with-right-border">
          <private-message-sidebar></private-message-sidebar>
        </div>

        <div class="col-sm-8">
          <form v-on:submit.prevent="handleFormSubmit()">
            <div class="form-group">
              <!-- <h1>{{pmStore.users}}</h1> -->
              
              <multiselect
                v-model="userSelected"
                :options="pmStore.users"
                :searchable="true"
                :close-on-select="true"
                :show-labels="false"
                track-by="id"
                label="name">
              </multiselect>
            </div>

            <div class="form-group">
              <label for="">Subject</label>
              <input type="text" v-model="subject" class="form-control" placeholder="Enter subject">
            </div>

            <div class="form-group">
              <label for="">Message</label>
              <textarea name="message" v-model="message" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary">
              <i class="fa fa-save"></i> Send
            </button>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
  import {mapState} from 'vuex'

  export default {
    props: {
        user: {required: true}
    },
    computed: {
      ...mapState({
        pmStore: state => state.PrivateMessageStore
      })
    },
    created () {
      this.$store.dispatch('getUserList')
    },
    data () {
      return {
          userSelected: null,
          subject: '',
          message: ''
      }
    },
    methods: {
      handleFormSubmit () {
        let postData = {
          'sender_id': this.user.id,
          'receiver_id': this.userSelected.id,
          'message': this.message,
          'subject': this.subject
        }

        this.$store.dispatch('sendPrivateMessage', postData)
          .then(response => {
            location.href = '/index';
          })
      }
    }
  }
</script>

