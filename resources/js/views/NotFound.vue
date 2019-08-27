<template>
  <div class="wrap-404">
    <div class="content">
      <div class="title">404</div>
      <div class="subtitle">NOTHING FOUND</div> 
      <div class="description">You are on the wrong path. Try to navigate to <router-link to="/">Home</router-link></div> 
    </div>
  </div>  
</template>
<style scoped>
  @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');

  .wrap-404 {
    background: url(https://bashcloud.github.io/404.jpg) center bottom;
    background-size: cover;    
    display:flex;
    justify-content: center;
    align-items: flex-end;
    height: 100%;        
    text-align: center;
  }

  .content{
    font-family: Roboto, sans-serif;
    color:#fff;
    opacity: 0.4;
    width: 100%;
    text-align: center;
    user-select: none;
  }

  .title{
    font-size: 20vh;
    font-weight: 900; 
    opacity: 0.5;
  }

  .subtitle {
    font-size: 5vh;
    font-weight: 600;
    padding-bottom: 2vh;
  }

  .description{
    font-size:2vh;
    padding-bottom: 4vh;
  }
</style>