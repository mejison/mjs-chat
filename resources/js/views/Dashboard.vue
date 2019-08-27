<template>
  <div class="settings">
    <div class="profile">
      <h1>Setting</h1>
      <div class="profile-img">
        <img src="https://placehold.it/150" alt="profile" />
      </div>
      <h3 class="name">Narla Chaw</h3>
      <span class="phone">+61 896 98587625</span>
    </div>
    <div class="settings-items">
      <a href="#" class="item border">
        Set Profile Photo
        <button class="btn btn-back"></button>
      </a>
      <a href="#" class="item border">
        Privacy and Security
        <button class="btn btn-back"></button>
      </a>          
      <a href="#" class="item border">
        Data and Storage
        <button class="btn btn-back"></button>
      </a>
      <a href="#" class="item">
        Notifications
        <button class="btn btn-back"></button>
      </a>          
      <a href="#" class="item logout" @click.prevent="onClickLogOut">
        Log Out
      </a>
    </div>
    <div class="menu-bar">
      <div class="item">
        <img src="/images/menu-bar/user.png" alt="user" />
      </div>
      <div class="item">
        <img src="/images/menu-bar/chat.png" alt="chat" />
      </div>
      <div class="item">
        <img src="/images/menu-bar/phone.png" alt="phone" />
      </div>
      <div class="item active">
        <img src="/images/menu-bar/setting.png" alt="setting" />
      </div>
    </div>
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
<style scoped>
.settings {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.profile {
  text-align: center;
  padding: 25px;
}

.profile .profile-img {  
  width: 150px;
  height: 150px;
  overflow: hidden;  
  border-radius: 50%;
  margin: 35px auto;    
  object-fit: cover;
}

.profile .profile-img img {
  object-fit: cover;
  object-position: center;
}

.profile .phone,
.profile h1,
.profile .name {
  color: #fff;
}

.profile h1 {
  font-size: 25px;
  font-family: Montserrat, Arial;
  font-weight: bold;
}

.profile .name {
  font-size: 30px;
  margin-bottom: 10px;  
  font-family: "Proxima Nova Rg";
  font-weight: bold;
}

.profile .phone {
  font-family: "Proxima Nova Rg";
  font-weight: normal;
  font-size: 22px;
}


.settings-items {
  background-color: #ededed;
  padding: 20px 0;
  display: flex;
  flex-direction: column;
  margin-top: auto;
  padding-bottom: 55px;
}

.settings-items .item {
  background-color: #fff;
  color: #666666;
  padding: 22px 40px;
  font-family: "Proxima Nova Rg";
  font-weight: bold;
  text-decoration: none;
  font-size: 20px;  
  position: relative;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.settings-items .item.border:after {
  content: '';
  left: 30px;
  right: 0;
  bottom: 0;
  position: absolute;
  border-bottom: 1px solid #666666;
}

.settings-items .item.logout {
  margin-top: 20px;
  color: #e5453b;
}

.btn.btn-back {
  margin-left: auto;  
  background: url(/images/back-icon-grey.png);
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
  border: none;  
  outline: none;
  width: 30px;
  height: 30px;
}
</style>