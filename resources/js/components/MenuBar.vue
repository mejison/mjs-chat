<template>
  <div class="menu-bar">
    <div 
      class="item" 
      :class="{'active': $route.name == 'user'}"
      @click="$router.push({name: 'user'})"
      >
      <img src="/images/menu-bar/user.png" alt="user" />
    </div>
    <div 
      class="item" 
      :class="{'active': $route.name == 'chat'}"
      @click="$router.push({name: 'chat'})"
      >
      <img src="/images/menu-bar/chat.png" alt="chat" />
    </div>
    <div 
      class="item" 
      :class="{'active': $route.name == 'phone'}"
      @click="$router.push({name: 'phone'})"
      >
      <img src="/images/menu-bar/phone.png" alt="phone" />
    </div>
    <div 
      class="item active"
      :class="{'active': $route.name == 'profile'}"
      @click="$router.push({name: 'profile'})"
      >
      <img src="/images/menu-bar/setting.png" alt="setting" />
    </div>
  </div>
</template>
<script>
  export default {
    name: 'menu-bar',
    data() {
      return {

      }
    },
    methods: {

    },
  }
</script>