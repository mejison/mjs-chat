<template>
  <router-view></router-view>
</template>
<script>
  import { mapActions } from 'vuex';

  export default {
    created() {
      this.getProfile()
    },
    methods: {
      ...mapActions('Profile', ['getProfile']),
    }
  }
</script>