<template>
  <div class="sign-wrap">
    <div class="sign-in">
      <form
        novalidate="novalidate"
        @submit.prevent="onSubmitSignIn"
        >        
        <div class="title">
          <h1>COLORISTIC</h1>
          <h3>Quick chat</h3>
        </div>
        <input 
          type="text"
          class="email"
          placeholder="Email"
          v-validate.continues="'required|email'"
          :class="{'has-error': errors.has('email')}"
          name="email"
          v-model="signin.email"
        />
        <input 
          type="password"
          class="password"
          placeholder="Password"
          name="password"
          v-validate.continues="'required'"
          :class="{'has-error': errors.has('password')}"
          v-model="signin.password"
        />
        <l-button type="submit" class="btn" :spinner="spinner">sigin in</l-button>        
      </form>        
    </div>
    <socials />
    <div class="referral-link">      
      <router-link to="/forgot-password">I forgot password</router-link>
      <router-link to="/signup">Create new account</router-link>
    </div>
  </div>
</template>
<script>
import { mapActions } from 'vuex'
import { Socials, lButton } from '../components';
export default {
  name: 'Login',
  components: {
    'socials': Socials,
    'l-button': lButton,
  },
  data() {
    return {
      spinner: false,
      signin: {
        email: '',        
        password: '',
      },
      current: 0,
    }
  },
  mounted() {
    const firstField = this.$validator.fields.items[0].name
    this.touched = [firstField];
  },
  methods: {
    ...mapActions('Auth', ['login']),
    onSubmitSignIn() {
      this.spinner = true
      this.$validator.validate().then(r => {
        if (r) {
          this.login(this.signin).then(r => {
            this.spinner = false
            let { data } = r.data
            if (data && data.access_token) {
              this.$cookie.set('token', data.access_token)
              setTimeout(() => {
                this.$router.push({name: 'profile'})
              }, 2000)
            }
          })
          return
        }
        this.spinner = false
      })
    },
  }
}
</script>
<style scoped>
.sign-wrap {
  background-image: url('/images/auth-bg.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  height: 100%;
  display: flex;
  justify-content: center;
  flex-direction: column;
}

h1, h3 {
  color: #fff;
  text-align: center;
  font-family: "Montserrat";
}

.title {
  margin: 50px auto;
}

.sign-in {
  margin: auto 20px;
}

.sign-in input {
  width: 100%;
  border: none;
  background: rgba(0, 0, 0, .5);
  padding: 10px;
  border: 1px solid #44484d;  
  color: #fff;
}

.sign-in input:focus {
  outline: none;
}

input.username {
  border-top-left-radius: 4px;
  border-top-right-radius: 4px;
  font-family: "Proxima Nova Rg";
}

input.password {
  border-top: none;
  font-family: "Proxima Nova Rg";
}

.sign-in .btn {
  margin-top: 30px;
  width: 100%;
  color: #fff;
  text-transform: uppercase;
  background-color: #d4445c;
  border-radius: 2px;
  padding: 10px;
  border: none;
  font-family: "Proxima Nova Rg";
}

.referral-link {
  margin-top: auto;
  display: flex;
  justify-content: space-around;
  margin-bottom: 20px;
}

.referral-link a {
  text-decoration: none;
  color: #fff;
  font-family: "Proxima Nova Rg";
  font-size: 13px;
}
</style>