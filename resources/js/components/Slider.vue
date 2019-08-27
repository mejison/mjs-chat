<template>  
  <div class="slider" id="slider">
    <div class="slider-wrap">
      <div 
        class="slide"          
        v-for="(s, index) in slides"
        :style="{transform: `translateX(${position[index]}px)`}"          
        :key="`${index}-slide`"
      >
        <div class="slide-image">
          <img 
            :src="s.img" 
            alt="`${index}`-slide" />
        </div>
        <h1 class="title">{{ s.title }}</h1>
        <h3 class="desc">{{ s.description }}</h3>
      </div>
    </div>
    <div class="dots">
      <div 
        class="dot"
        v-for="(s, index) in slides"
        :key="`${index}-dot`"
        @click="active = index"
        :class="{'active': index == active}"
      ></div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'Slider',
    data() {
      return {
        active: 0,
        slides: [
          {
            img: '/images/slides/slide-1.png',
            title: 'Fast Messaging',
            description: 'Chat app fast messaging and powerful than any other application',
          },
          {
            img: '/images/slides/slide-2.png',
            title: 'Secure System',
            description: 'Chat app secure system from hacker attack and we guarantee your data safe',
          },
          {
            img: '/images/slides/slide-3.png',
            title: 'Free Call and Chat',
            description: 'Chat app free call and chat anytime and everytime',
          },
        ],
        xDown: null,
        yDown: null,
        slide: {
          width: 0,
        }
      }
    },
    computed: {
      position() {
        let pos = [...new Array(this.slides.length)];
        return pos.map((p, index) => {
          return (this.slide.width * index) - (this.active * this.slide.width) * 2
        })
      }
    },
    mounted() {
      this.listenSwipes()      
      let slider = document.getElementById('slider')
      this.slide.width = slider.clientWidth
      window.addEventListener("resize", () => {
        this.slide.width = slider.clientWidth  
      })
    },
    methods: {
      handleTouchStart(e) {
        const firstTouch = this.getTouches(e)[0]
        this.xDown = firstTouch.clientX
        this.yDown = firstTouch.clientY
      },
      handleTouchMove(e) {
        if ( ! this.xDown || ! this.yDown ) {
            return;
        }

        var xUp = e.touches[0].clientX;                                    
        var yUp = e.touches[0].clientY;

        var xDiff = this.xDown - xUp;
        var yDiff = this.yDown - yUp;

        if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
            if ( xDiff > 0 ) {
              this.leftSwipe()
            } else {
              this.rightSwipe()
            }                       
        }
        this.xDown = null;
        this.yDown = null;                                             
      },
      getTouches(e) {
        return e.touches || e.originalEvent.touches;
      },
      listenSwipes() {
        document.addEventListener('touchstart', this.handleTouchStart, false)
        document.addEventListener('touchmove', this.handleTouchMove, false)                                                                        
      },
      leftSwipe() {
        if (this.active != this.slides.length - 1) {
          this.active ++;
          return 
        }
        this.active = 0
      },
      rightSwipe() {
        if (this.active != 0) {
          this.active --;          
          return 
        }
        this.active = this.slides.length - 1
      },
    },
  }
</script>
<style>  
.slider .slider-wrap {
  display: flex;    
  overflow: hidden;
}

.slider .slide {
  min-width: 100%;
  padding: 0 25px;
  transition: transform .2s;
}

.btn.btn-start {
  background-color: #fff;
  color: #343635;
  font-size: 20px;
  font-family: "Proxima Nova Rg", Arial;
  font-weight: bold;
  border-radius: 2px;
  padding: 10px 0;
  border: none;
  width: 80%;
  outline: none;
  margin: 0 auto;
  text-transform: uppercase;
  position: fixed;
  bottom: 35px;
  left: 10%;
  right: 10%;
}

.slider .dots {
  display: flex;
  justify-content: center;
  margin-bottom: 50px;
}

.dots .dot {
  width: 13px;
  height: 13px;
  border-radius: 50%;
  border: 1px solid #fff;
  margin-left: 10px;
}

.dots .dot.active {
  background-color: #fff;
}

.slider .slide .title,
.slider .slide .desc {
  color: #fff;
  text-align: center;
}

.slider .slide .title {
  font-family: Montserrat, Arial;
  font-size: 25px;  
  margin-bottom: 30px;
}

.slider .slide .desc {
  font-family: "Proxima Nova Rg", Arial;
  font-size: 15px;
  margin-bottom: 50px;
  font-weight: normal;
}

.slider .slide .slide-image {  
  display: flex;
  justify-content: center;
  margin-bottom: 40px;
}

.slider .slide .slide-image img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  object-position: center center;
}
</style>