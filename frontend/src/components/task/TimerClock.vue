<template>
      <!-- <img class="img" src="@/assets/cronometro.png" /> --> 
      <div class="btns" v-if="isActive">
        <span class="timer">{{ taskName }}</span>
        <span class="timer">{{zfill(hour)}}:{{zfill(min)}}:{{zfill(sec)}}</span>
        <button class="btn btn-outline-light" @click="play">
          <b-icon icon="pause" v-if="timer !== null"/><b-icon icon="play" v-if="timer === null"/>
        </button>
        <button class="btn btn-outline-light" @click="assignTime">Finalizar</button>        
      </div>
  </template>
  
  <script>
  import axios from "axios";

  export default {
    name: 'TimerClock',
    data(){
      return{
        sec: 0,
        min: 0,
        hour: 0,
        timer: null
      }
    },
    computed: {
      isActive: {
        get() {
          return this.$store.state.timer.isActive;
        },
        set() {
          this.$store.dispatch('timer/change')
        }
      },
      taskName:{
        get(){
          return this.$store.state.timer.taskName;
        }
      },
      taskId:{
        get(){
          return this.$store.state.timer.taskId;
        }
      }
    },
    watch: {
      isActive: function(newValue) {
        if(newValue){
          this.play();
        }
      }
    },
    methods: {
      zfill(number){
        return number.toString().padStart(2,0)
      },
      play() {        
        if (this.timer === null){
          this.playing()
          this.timer = setInterval(()=> this.playing(), 1000)
        } else {
          this.stopTimer();
        }
      },
      stopTimer(){
        // Pausa en el reloj
        clearInterval(this.timer);
        this.timer = null;
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
      clearTimer(){
        this.timer = null;          
        this.sec = 0;
        this.min = 0;
        this.hour = 0;
      },
      assignTime(){
        this.stopTimer();
          
        try {
          var payload = {
            "id": this.taskId,
            "time": this.sec + this.min * 60 + this.hour * 3600
          };
          axios.post(
            "http://localhost:9980/api/schedule/assignTimeToTask",
            payload
          );
        } catch (error) {
          console.log(error);
        }

        this.clearTimer();
        this.isActive = !this.isActive
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