/*--------------Alap---------------

import 'bootstrap/dist/css/bootstrap.min.css' ------>  + npm install --save bootstrap
import 'bootstrap'0

import router from './router'                 ------> +  npm install vue-router@4

import './assets/main.css'                    ------> másik css-re átírni

import axios from 'axios'                     ------> +  npm install axios

import { createApp } from 'vue'
import App from './App.vue'


createApp(App)
    .use(router)
    .use(axios)
    .mount('#app')

*/


import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'

import router from './router'

import './assets/openpage.css'

import axios from 'axios'

import { createApp } from 'vue'
import App from './App.vue'

createApp(App)
    .use(router)
    .use(axios)
    .mount('#app')
