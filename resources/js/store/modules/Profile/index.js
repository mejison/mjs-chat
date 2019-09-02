import api from "../../../api";

const profile = {
  namespaced: true,
  state: {
    profile: [],
  },
  getters: {},
  actions: {
    getProfile({ commit }) {
      return api.getProfile().then(r => {
        let { data } = r.data
        commit('setProfile', data)
      })
    },
    updateProfilePhoto({ commit }, formdata) {
      return api.updateProfilePhoto(formdata)
    },
  },
  mutations: {
    setProfile(state, payload) {
      state.profile = payload
    },
  },
}

export default profile