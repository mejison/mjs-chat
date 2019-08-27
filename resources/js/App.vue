<template>
  <div id="app">
    <div class="container">
      <div class="app">
        <transition :name="transitionName" mode="out-in">
          <router-view></router-view>
        </transition>
      </div>    
    </div>
  </div>
</template>
<script>  
  export default {
    name: 'App',  
    data() {
      return {
        transitionName: "slide-right"
      }
    },
    watch: {
      $route(to, from) {
        if (from.meta.transition) {
          this.transitionName = from.meta.transition 
          return
        }
        this.transitionName = to.meta.transition ? to.meta.transition : ""
      }
    }
  }
</script>
<style>
  @import 'app.css';
  @import 'fonts.css';
  
.slide-left-enter-active,
.slide-left-leave-active,
.slide-right-enter-active,
.slide-right-leave-active {
  transition-duration: 0.5s;
  transition-property: height, opacity, transform;
  transition-timing-function: cubic-bezier(0.55, 0, 0.1, 1);
  overflow: hidden;
}

.slide-left-enter,
.slide-left-leave-active {
  transform: translate(100vw, 0);
}

.slide-right-enter,
.slide-right-leave-active {
  transform: translate(-100vw, 0);
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
  opacity: 0;
}
</style>