export default {
  methods: {
    getPhoto(profile) {
      return profile.avatar ? profile.avatar : '//placehold.it/100x100'
    }
  }
}