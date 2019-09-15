<template>
  <div>
      <div class="navbar">
        <div class="action left">
          <a href="#" @click.prevent="$router.go(-1)">
            <img src="/images/navbar/back-icon.png" alt="btn-prev" />
          </a>          
        </div>
        <div class="title">
          <h1 v-if="dialog.opponent">{{ dialog.opponent.name }}</h1>
          <span class="active-status">online</span>
        </div>
        <div class="action right">
          <a href="#" class="profile-image">
            <img 
              v-if="dialog.opponent"
              :src="getPhoto(dialog.opponent)"
              alt="" />
          </a>
        </div>
      </div>
      <div class="message-poligon" id="messages">
        <div 
          class="message"
          v-for="(m, index) in messages"
          :key="`${index}-message`"  
          :class="{'me': isMeMessage(m)}"
          >
          {{ m.message }}
        </div>
      </div>
      <form @submit.prevent="onSendMessage">
        <div class="message-field">        
          <div class="photo">
            <a href="#">
              <img src="/images/chat/camera-icon.png" alt="camera" />
            </a>
          </div>
          <div class="attach">
            <a href="#">
              <img src="/images/chat/attach-icon.png" alt="camera" />
            </a>
          </div>
          <div class="input">
            <input 
              type="text" 
              placeholder="Type message..."
              v-model="message"
              />
          </div>
          <div class="send">
            <a href="#" @click.prevent="onSendMessage">
              <img src="/images/chat/icon-send1.png" alt="icon-send" />
            </a>
          </div>        
        </div>
      </form>
  </div>
</template>
<script>
import { mapState, mapActions } from 'vuex'
import profileMixin from '../mixins/profile'

export default {
  name: 'Chat',
  mixins: [
    profileMixin
  ],
  data() {
    return {
      message: '',
    }
  },
  mounted() {
    this.getMessages(this.$route.params.dialog)
    this.getDialog(this.$route.params.dialog)
    window
      .Echo
      .private(`dialog.${this.$route.params.dialog}`)
      .listen("MessageSend", this.onReceiveMessage)    
  },
  watch: {
    messages() {
      this.$nextTick(() => {
        this.scrollToDown()
      })
    },
  },
  computed: {
    ...mapState('Messages', ['messages', 'dialog']),
    ...mapState('Profile', ['profile']),
  },
  methods: {
    ...mapActions('Messages', ['sendMessage', 'getMessages', 'getDialog']),
    isMeMessage(message) {
      return message.sender_id === this.profile.id
    },
    onSendMessage() {
      this.sendMessage({
        dialog: this.dialog,
        data: {
          message: this.message,
          recipient_id: this.dialog.opponent.id,
        }
      }).then(r => {
        this.message = ''
      })
    },
    onReceiveMessage(e) {
      this.getMessages(this.$route.params.dialog)
    },
    scrollToDown() {
      let element = document.getElementById('messages')
      window.scrollTo({top: element.offsetHeight, behavior: "smooth"})
    }
  }
}
</script>

<style scoped>
.navbar {
  z-index: 3;
}

.navbar .profile-image {
  border-radius: 50%;
  width: 30px;
  height: 30px;
  overflow: hidden;
  display: inline-block;  
}

.navbar .profile-image img {
  object-fit: cover;
  width: 100%;
  height: 100%;
}

.navbar .left img {    
  height: 25px;
  object-fit: contain;
}

.navbar .title h1, .navbar .title span {
  font-family: "Proxima Nova Rg";
  font-weight: normal;
}

.navbar .title {
  text-align: center;
}

.navbar .title span {
  font-size: 13px;
}

.navbar .active-status {
  color: #fff;
  
}

.message-field {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  background-color: #fff;
  border-top: 1px solid #bbbcbc;
  padding: 10px 15px;
  align-items: center;
}

.message-field .attach img,
.message-field .photo img {
  width: 25px;
  object-fit: cover;
  object-position: center;
}

.message-field .attach img {
  margin-left: 10px;
  margin-right: 10px;
}

.message-field .input {
  width: 100%;
}

.message-field .input input {
  border: none;
  outline: none;
  width: 100%;
  color: #7c7c7c;  
  font-family: "Proxima Nova Rg";  
}

.message-field .send {
  margin-left: auto;
}

.message-field .send img {
  width: 30px;
}

.message-poligon {
  background-color: #f9fafc;
  height: 100%;
  display: flex;
  flex-direction: column;
  padding: 15px;
  padding-top: 65px;
  padding-bottom: 65px;
  overflow-x: none;
  overflow-y: auto;
}

.message-poligon .message {
  display: inline-block;
  width: fit-content;
  padding: 15px 30px;
  margin-bottom: 20px;
  border-radius: 4px;
  color: #737373;
  font-family: "Proxima Nova Rg";  
  font-weight: normal;
  background-color: #fff;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  position: relative;
}

.message-poligon .message.me {
  background-color: #6e5694;
  margin-left: auto;
  color: #fff;
}


.message.me:after {
  content: '';
  background-color: #6e5694;
  position: absolute;
  bottom: 0px;
  right: -10px;
  width: 15px;
  height: 13px;
  border-left: none;
  border-right: none;
  border-top: none;
}

.message.me:before {
  content: '';
  background-color: #f9fafc;
  position: absolute;
  z-index: 2;
  bottom: 0;
  right: -15px;
  width: 15px;
  height: 15px;  
  border-bottom-left-radius: 50px 50px;  
}

.message:not(.me) {
  border-bottom-left-radius: 0;
}

.message:not(.me):after {
  content: '';
  background-color: #fff;
  position: absolute;
  bottom: 0px;
  left: -14px;
  width: 15px;
  height: 15px;
  box-shadow: 0 1px 0px 0 rgba(0, 0, 0, 0.1), 0 2px 0px 0 rgba(0, 0, 0, 0.02);
}

.message:not(.me):before {
  content: '';
  background-color: #f9fafc;
  position: absolute;
  z-index: 2;
  bottom: 0px;
  left: -15px;
  width: 15px;
  height: 15px;
  border-bottom-right-radius: 50px 50px;
  box-shadow: 0 1px 0px 0 rgba(0, 0, 0, 0.1), 0 2px 0px 0 rgba(0, 0, 0, 0.02);
}
</style>