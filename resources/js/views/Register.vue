<template>
  <div class="sign-wrap">
    <div class="sign-in">
      <form
        novalidate="novalidate"
        @submit.prevent="onSubmitSignUp"
        >        
        <div class="title">
          <h1>COLORISTIC</h1>
          <h3>Quick chat</h3>
        </div>
        <input 
          type="text"
          class="username"
          placeholder="Name"
          v-validate="'required'"
          :class="{'has-error': errors.has('name')}"
          name="name"
          v-model="signup.name"
        />
        <input 
          type="text"
          class="email"
          placeholder="Email"
          v-validate="'required|email'"
          :class="{'has-error': errors.has('email')}"
          name="email"
          v-model="signup.email"
        />
        <input 
          type="password"
          class="password"
          placeholder="Password"
          name="password"
          v-validate="'required'"
          :class="{'has-error': errors.has('password')}"
          v-model="signup.password"
        />
        <input 
          type="password"
          class="password_confirmation"
          placeholder="Password Confirmation"
          name="password_confirmation"
          v-validate="'required'"
          :class="{'has-error': errors.has('password_confirmation')}"
          v-model="signup.password_confirmation"
        />        
        <l-button type="submit" class="btn" :spinner="spinner">sigin up</l-button>        
      </form>        
    </div>
    <socials />
    <div class="referral-link">            
      <router-link to="/signin">Allready reigistered?</router-link>
    </div>
  </div>
</template>
<script>
import { mapActions } from 'vuex'
import { Socials, lButton } from '../components';

export default {
  name: 'Register',
  components: {
    Socials,
    lButton,
  },
  data() {
    return {
      spinner: false,
      signup: {
        email: '',
        name: '',
        password: '',
        password_confirmation: '',
      }
    }
  },
  methods: {
    ...mapActions('Auth', ['register']),    
    onSubmitSignUp() {
      this.spinner = true;
       this.$validator.validate().then((res) => {
        if(res) {
          this.register(this.signup).then(r => {
            this.spinner = false;
            let { data } = r.data
            if (data.access_token) {
              this.$cookie.set('token', data.access_token)
               setTimeout(() => {
                this.$router.push({name: 'profile'})
              }, 2000)
            }        
          })
          return 
        }
        this.spinner = false;
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
  font-family: "Proxima Nova Rg";
}

input.email {
  border-top: none;
  font-family: "Proxima Nova Rg";
}

input.password {
  border-top: none;
  font-family: "Proxima Nova Rg";
}

input.password_confirmation {
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
  margin-left: auto;
  margin-right: 20px;
}
</style>