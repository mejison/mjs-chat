<template>
  <div class="settings">
    
  </div>
</template>
<script>
  export default {
    name: 'Dashboard',
    data() {
      return {

      }
    },
    methods: {
      onClickLogOut() {
        this.$cookie.delete('token')
        setTimeout(() => {
          this.$router.push({name: 'signin'})
        }, 500)        
      }
    },
  }
</script>