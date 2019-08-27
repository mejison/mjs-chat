<template>
  <div class="socials">
    <span>or sign in  with</span>
    <div class="socials-list">
      <div class="soc">
        <a href="">
          <img src="/images/facebook.png" alt="facebook" />
        </a>            
      </div>
      <div class="soc">
        <a href="">
          <img src="/images/twitter.png" alt="twitter" />
        </a>            
      </div>
      <div class="soc">
        <a href="">
          <img src="/images/googleplus.png" alt="googleplus" />
        </a>
      </div>
    </div>        
  </div>
</template>
<script>
export default {
  name: 'Socials',
}
</script>
<style scoped>
  .socials {
    align-items: center;
    display: flex;
    flex-direction: column;
  }

  .socials span {
    color: #fff;
    font-family: "Proxima Nova Rg";
    font-size: 15px;
  }

  .socials .socials-list {  
    display: flex;
    justify-content: space-between;
  }

  .socials .socials-list .soc img {
    width: 34px;
    height: 34px;
    margin: 15px 5px;
  }
</style>