<template>
  <div>
    <slider />    
    <button 
      type="button"
      class="btn btn-start" 
      @click="onClickStart">let's start</button>
  </div>
</template>
<script>
import { Slider } from '../components';

export default {
  components: {
    Slider
  },
  name: 'Home',
  methods: {
    onClickStart() {
      this.$router.push({
        name: 'signin',
      })
    },
  },
}
</script>
<style>
.app {  
  background-color: #6e5694;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
</style>

