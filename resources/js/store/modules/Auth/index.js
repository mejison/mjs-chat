import api from '../../../api'

const Auth = {  
  namespaced: true,
  state: {

  },
  getters: {

  },
  actions: {
    register({ commit }, payload) {
      return api.register(payload)
    },
    login({ commit }, payload) {
      return api.login(payload)
    }
  },
  mutations: {

  },
}

export default Auth