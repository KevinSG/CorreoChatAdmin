import Vue from 'vue'
import _ from 'lodash'

const state = {
  notifications: [],
  messageRec: [],
  messageSent: [],
  message: {
    subject: '',
    message: '',
    sender: {}
  },
  users: []
}

const mutations = {
  // SET_USER_PM_NOTIFICATIONS (state, notifications) {
  //   state.notifications = notifications
  // },
  SET_MESSAGES_REC (state, messages) {
    state.messageRec = messages;
  },
  SET_MESSAGE_VIEW (state, message) {
    state.message = message
    console.log(state.message);
  },
  CLEAR_MESSAGE_VIEW (state) {
    state.message = {
      subject: '',
      message: '',
      sender: {}
    }
  },
  SET_USER_LIST (state, users) {
    state.users = users.data
  },
  SEND_PRIVATE_MESSAGE (state, message) {
    state.messageSent.push(message)
  },
  SET_MESSAGES_SENT (state, messages) {
    state.messageSent = messages
  },
  // NEW_PM_NOTIFICATION (state, message) {
  //   state.notifications.unshift(message)
  //   state.messageRec.unshift(message)
  // },
  // MESSAGE_READ_NOTIFICATION (state, message) {
  //   _.forEach(state.messageRec, function (value, key) {
  //     if (message.id === value.id) {
  //       state.messageRec[key] = value
  //     }
  //   })

  //   _.forEach(state.notifications, function (value, key) {
  //     if (message.id === value.id) {
  //       state.notifications.splice(key, 1)
  //     }
  //   })
  // }
}

const actions = {
  // getUserNotifications: ({commit}) => {
  //   let postData = {}
  //   return axios.post(`/api/v1/get-private-messages`, postData, {headers: getHeader()})
  //     .then(response => {
  //       Vue.$logger('info', 'getUserNotifications response', response)
  //       commit('SET_USER_PM_NOTIFICATIONS', response.body.data)
  //     })
  // },
  setUserMessagesRec: ({commit}, user) => {
    let postData = {id: user.id}
    console.log(user.id);
    //console.log(user);
    return axios.post(`/api/v1/get-private-messages/{id}`, postData)
      .then(response => {
        console.log(response);
        commit('SET_MESSAGES_REC', response.data)
      })
  },
  getPrivateMessageById: ({commit}, id) => {
    let postData = {id: id}
    return axios.post(`/api/v1/get-private-message/{id}`, postData)
      .then(response => {
        commit('SET_MESSAGE_VIEW', response.data)
      })
  },
  clearMessageView: ({commit}) => {
    commit('CLEAR_MESSAGE_VIEW')
  },
  sendPrivateMessage: ({commit}, postData) => {
    return axios.post(`/api/v1/send-private-message`, postData)
      .then(response => {
        console.log(response)
        commit('SEND_PRIVATE_MESSAGE', response.data)
        return response
      })
  },
  setUserMessagesSent: ({commit}, user) => {
    let postData = {id: user.id}
    return axios.post(`/api/v1/get-private-messages-sent/{id}`, postData)
      .then(response => {
        commit('SET_MESSAGES_SENT', response.data)
        return response
      })
  },
  getUserList: ({commit}) => {
    return axios.get(`/api/v1/user-list`)
      .then(response => {
        if (response.status === 200) {
          commit('SET_USER_LIST', response.data)
          return response.data
        }
      })
  },
  // newMessageNotification: ({commit}, message) => {
  //   commit('NEW_PM_NOTIFICATION', message)
  // },
  // messageReadNotification: ({commit}, message) => {
  //   commit('MESSAGE_READ_NOTIFICATION', message)
  // }
}

export default {
      state, 
      mutations, 
      actions
}