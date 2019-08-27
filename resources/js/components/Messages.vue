<template>
  <div>
    <ul>
      <li
        v-for="(m, index) in messages"
        :key="index"
      >
        {{ m.message }}
      </li>
    </ul>
    <form>
      <textarea v-model="message" cols="30" rows="10"></textarea>
      <button @click.prevent="onSendMessage">Send</button>
    </form>    
  </div>
</template>
<script>
import { mapState, mapActions } from 'vuex';
export default {
  name: 'Messages',
  data() {
    return {
      message: '',
    }
  },
  mounted() {
    this.getMessages(this.current)

    window
    .Echo
    .private(`dialog.${this.current.id}`)
    .listen("MessageSend", this.onReceiveMessage)    
  },
  computed: {
    ...mapState('Messages', ['current', 'messages']),
  },
  methods: {
    ...mapActions('Messages', ['sendMessage', 'getMessages']),
    onSendMessage() {
      this.sendMessage({
        dialog: this.current,
        data: {
          message: this.message,
          recipient_id: this.current.user_to_id,
        }
      })
    },
    onReceiveMessage(e) {
      console.log(e)
    }
  }
}
</script>

