import Vue from 'vue';

const request = (url, data, method = 'get') => {
  return axios[method](url, data).then(json => {
    let { message, status } = json.data;

    Vue.toasted[status](message, {
      theme: "bubble",
      containerClass: ["vue-notify", [status]],
      position: "top-center",
      duration: 2000
    });

    return Promise.resolve(json)
  })
}

const auth = {
  register(data) {
    return request('/api/v1/register', data, 'post')    
  },
  login(data) {
    return request('/api/v1/login', data, 'post')
  },  
}

const messages = {
  getDialogs() {
    return request('/api/v1/user/dialogs')
  },
  getMessages(dialog) {
    return request(`/api/v1/user/message/${dialog.id}`)
  },
  sendMessage(dialog, data) {
    return request(`/api/v1/user/message/${dialog.id}`, data, 'post')
  },
}

export default {
  ...auth,
  ...messages,
}