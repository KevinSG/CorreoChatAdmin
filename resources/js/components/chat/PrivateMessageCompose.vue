<template>
  <div class="container">
    <section class="header">
      <h1 class="page-title">Mesajes privados - <small>Enviar mensaje</small></h1>
      <br>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-8">
          <form v-on:submit.prevent="handleFormSubmit()">
            <div class="form-group">
              <!-- <h3>{{pmStore.users}}</h3> -->
              <multiselect v-model="userSelected" placeholder="Seleciona un usuario" :options="pmStore.users" :searchable="true" :close-on-select="true" :show-labels="true" track-by="sender_id" label="sender_id">
              </multiselect>

            </div>

            <div class="form-group">
              <label for="">Subject</label>
              <input type="text" v-model="subject" class="form-control" placeholder="Enter subject" required>
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
    data () {
      return {
          userSelected: null,
          subject: '',
          message: ''
      }
    },
    computed: {
      ...mapState({
        pmStore: state => state.PrivateMessageStore
      })
    },
    created () {
      this.$store.dispatch('getUserList', this.user)
    },
    methods: {
      handleFormSubmit () {
        console.log(this.userSelected);
        let postData = {
          'sender': this.user.email,
          'receiver': this.userSelected.sender_id,
          'subject': this.subject
        }
        this.$store.dispatch('sendSubject', postData)
          .then(response => {
            location.href = '/index';
          })
      }
    }
  }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css">

