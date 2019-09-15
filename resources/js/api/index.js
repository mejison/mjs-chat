import Vue from 'vue';

const request = (url, data, method = 'get') => {
  return axios[method](`/api/v1/${url}`, data).then(json => {    
    let { message, status } = json.data;     

    if (status) {
      Vue.toasted[status](message, {
        theme: "bubble",
        containerClass: ["vue-notify", [status]],
        position: "top-center",
        duration: 2000
      });
    }

    return Promise.resolve(json)
  }).catch(e => {
    let { errors } = e.response.data
    if (errors) {
      Object.values(errors).forEach(e => {
        e.forEach(error => {
          Vue.toasted['error'](error, {
            theme: "bubble",
            containerClass: ["vue-notify", ['error']],
            position: "top-center",
            duration: 2000
          });
        });
      });
    }
    return Promise.resolve(e.response)
  })
}

const auth = {
  register(data) {
    return request('register', data, 'post')    
  },
  login(data) {
    return request('login', data, 'post')
  },  
}

const messages = {
  getDialogs() {
    return request('user/dialogs')
  },
  getDialog(dialog_id) {
    return request(`user/dialog/${dialog_id}`)
  },
  getMessages(dialog_id) {
    return request(`user/message/${dialog_id}`)
  },
  sendMessage(dialog, data) {
    return request(`user/message/${dialog.id}`, data, 'post')
  },
}

const profile = {
  getProfile() {
    return request('profile')
  },
  updateProfilePhoto(data) {
    return request('profile/photo', data, 'post')
  },
}

export default {
  ...auth,
  ...messages,
  ...profile,
}