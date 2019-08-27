<template>
  <div>
    <Dialogs />
    <Messages v-if="current" />
  </div>
</template>
<script>

import {
  Dialogs, Messages
} from '../components'
import { mapState } from 'vuex';

export default {
  name: 'App',
  computed: {
    ...mapState('Messages', ['current']),
  },
  components: {
    Dialogs,
    Messages,    
  }
}
</script>

