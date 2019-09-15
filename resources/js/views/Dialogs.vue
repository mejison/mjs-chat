<template>
  <div>
      <div class="navbar">
        <div class="action left">
          <a href="#">Edit</a>
        </div>
        <div class="title">
          <h1>Chats</h1>
        </div>
        <div class="action right">
          <a href="#">
            <img src="/images/navbar/icon-new-chat.png" alt="btn-eidt" />
          </a>
        </div>
      </div>
      <div class="search-bar">
        <input 
          type="text" 
          class="input-search" 
          autofocus="autofocus" 
          placeholder="Search for message or user`" 
          v-model="filter.query"
          />
      </div>
      <div class="dialogs">
        <div 
          class="dialog"
          v-for="(d, index) in dialogsFiltered"
          :key="`${index}-dialog`"
          @click="onClickDialog(d)"
          >
          <div class="receiver-img">
            <img 
              :src="getPhoto(d.opponent)" 
              alt="receiver" 
              />
          </div>
          <div class="receiver-info">
            <div class="title">
              <h1>
                {{ d.opponent.name }}
              </h1>
              <span>
                {{ d.date_last_message }}
              </span>
            </div>
            <div class="short">
              <p>
                {{ d.context_last_message }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <menu-bar />
  </div>
</template>
<script>
  import MenuBar from '../components/MenuBar.vue'
  import { mapActions, mapState } from 'vuex'
  import profileMixin from '../mixins/profile'

  export default {
    components: {
      MenuBar,
    },
    mixins: [
      profileMixin,
    ],
    data() {
      return {
        filter: {
          query: '',
        }
      }
    },
    name: 'dialogs',
     mounted() {
      this.getDialogs()
    },
    methods: {
      ...mapActions('Messages', ['getDialogs', 'setCurrentDialog']),
      onClickDialog(d) {
        this.setCurrentDialog(d)
        this.$router.push({name: 'chat', params: { dialog: d.id }})
      },
    },
    computed: {    
      ...mapState('Messages', ['dialogs']),    
      dialogsFiltered() {
        return this.dialogs.filter(d => {
          return (d.opponent.name.toLowerCase().indexOf(this.filter.query.toLowerCase()) + 1) || 
                (d.context_last_message.toLowerCase().indexOf(this.filter.query.toLowerCase()) + 1)
        })
      }
    },
  }
</script>
<style scoped>  
  .dialogs {
    padding-top: 75px;
  }

  .search-bar {
    padding: 15px;
    background-color: #fff;
    position: sticky;
    top: 50px;
  }

  .input-search {
    background-color: #ceced2;
    border-radius: 4px;
    border: none;
    outline: none;
    color: #828282;  
    font-family: "Proxima Nova Rg";
    font-weight: normal;
    font-size: 16px;
    width: 100%;
    padding: 8px 15px;
  }

  .input-search::placeholder {
    color: #828282;
    font-family: "Proxima Nova Rg";
    font-weight: normal;
    text-align: center;
  }

  .dialogs {
    background-color: #fff;
    min-height: 100vh;  
    padding-left: 15px;
  }

  .dialogs .dialog {
    display: flex;
    align-items: center;
  }

  .dialogs .dialog .receiver-img {
    max-width: 120px;
    padding: 10px 10px 10px 0;
  }

  .dialogs .dialog .receiver-img img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    object-position: center;
  }

  .dialogs .dialog .receiver-info {
    padding: 10px 0;
    border-bottom: 1px solid #b2b2b2;
    padding-right: 15px;
    width: 100%;
  }

  .dialogs .dialog:last-child .receiver-info {
    border-bottom: none;
  }

  .dialogs .dialog .title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }

  .dialogs .dialog .title h1 {  
    font-family: "Proxima Nova Rg";
    font-weight: bold;
    font-size: 20px;
    color: #434343;
  }

  .dialogs .dialog .title span {
    color: #666666;
    font-family: "Proxima Nova Rg";
    font-weight: normal;
    font-size: 18px;
  }

  .dialogs .dialog .short p {
    color: #666666;
    font-family: "Proxima Nova Rg";
    font-weight: normal;
    font-size: 18px;
  }
</style>