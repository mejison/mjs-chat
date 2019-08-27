<template>
  <div>
    <ul>
      <li
        v-for="(d, index) in dialogs"
        :key="index">
        <a href="#" @click.prevent="onClickDialog(d)">
          {{ d.recipient.name }}
        </a>        
      </li>      
    </ul>
  </div>
</template>
<script>
import { mapState, mapActions } from 'vuex';
export default {
  name: 'Dialogs',
  mounted() {
    this.getDialogs()
  },
  methods: {
    ...mapActions('Messages', ['getDialogs', 'setCurrentDialog']),
    onClickDialog(d) {
      this.setCurrentDialog(d)
    },
  },
  computed: {    
    ...mapState('Messages', ['dialogs']),    
  }
}
</script>

