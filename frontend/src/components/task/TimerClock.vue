<template>
      <!-- <img class="img" src="@/assets/cronometro.png" /> --> 
      <div class="btns" v-if="isActive">
        <span class="timer">{{ taskName }}</span>
        <span class="timer">{{zfill(hour)}}:{{zfill(min)}}:{{zfill(sec)}}</span>
        <button class="btn btn-outline-light" @click="play">
          <b-icon icon="pause" v-if="timer !== null"/><b-icon icon="play" v-if="timer === null"/>
        </button>
        <button class="btn btn-outline-light" @click="clear">Finalizar</button>        
        <!-- <button class="btn btn-outline-light" @click="clearIntervalList">Borrar</button> -->
      </div>
  
      <!-- <div class="interval" v-show="intervalList.length > 0">
        
        <button class="btn btn-outline-light" @click="clearIntervalList">Borrar</button>
      </div>   -->
  </template>
  
  <script>
  export default {
    name: 'TimerClock',
    data(){
      return{
        sec: 0,
        min: 0,
        hour: 0,
        timer: null,
        intervalList: []
      }
    },
    computed: {
      isActive: {
        get() {
          return this.$store.state.timer.isActive;
        },
        set(value) {
          console.log(value);
          this.$store.dispatch('timer/change')
        }
      },
      taskName:{
        get(){
          return this.$store.state.timer.taskName;
        }
      }
    },
    watch: {
      isActive: function(newValue) {
        console.log(newValue);
        if(newValue){
          this.play();
        }
      }
    },
    methods: {
      zfill(number){
        return number.toString().padStart(2,0)
      },
      play(){
        
        if(this.timer === null){
          this.playing()
          this.timer = setInterval(()=> this.playing(), 1000)
        }
        else{
          clearInterval(this.timer);
          this.timer = null;
          this.pause();
        }
      },
      playing(){
        this.sec++
        if(this.sec >= 59){
          this.sec = 0;
          this.min++;
        }
        if(this.min >= 59){
          this.min = 0;
          this.hour++;
        }
      },
      pause(){
        this.intervalList.push(`${this.zfill(this.hour)}:${this.zfill(this.min)}:${this.zfill(this.sec)}`)
        console.log(this.intervalList)
      },
      clear(){
        // if(this.timer !== null){
        //   clearInterval(this.timer)
        //   this.timer = null
        // }
        // this.sec = 0;
        // this.min = 0;
        // this.hour = 0;
        // this.clearIntervalList();
        this.isActive = !this.isActive
      },
      clearIntervalList(){
        this.intervalList = []
        console.log(this.intervalList)
      }
    }
  }
  </script>
  
  <style>  
  .timer{
    color: rgb(7, 7, 7);
    font-size: 26px;
    text-align: center;
    color: white;
  }
  .interval ul li{
    list-style: none;
    padding: 15px;
    margin-bottom: 10px;
  }
  </style>