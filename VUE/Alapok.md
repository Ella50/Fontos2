Kezdetek:

npm init vue@latest 

npm install
npm install --save bootstrap
npm install vue-router@latest
npm install axios

npm run dev

api.exe futtatása (backend mappában)


feladatban benne van hogy milyen címen van az url elérése
feladatban a metódusok is (post, get, stb) szóval ha előre meg van csinálva akkor csak ki kell választani
sima vue setup, projektnévnek az amit a feladat megad, nem külön mappa létrehozás és utána vue
main.css-t átírni 




src/main.js-hez:
    import 'bootstrap/dist/css/bootstrap.min.css'
    import 'bootstrap'



src/router.js:
    import { createRouter, createWebHistory } from 'vue-router'
    import Home from './pages/Home.vue'

    const routes = [
    {
    path: '/',
    name: 'Home',
    component: Home
    },
    ]

    const router = createRouter({
    history: createWebHistory(),
    routes
    })
    export default router


src/pages/Home.vue

main.js:
    import router from './router'
    createApp(App)
    .use(router)

    import './assets/main.css' helyett import './assets/openpage.css'


Home.vue-ba a megadott oldal kinézet
helyett router-link, href helyett to



main.js:
    import axios from 'axios'
    .use(axios)

router.js:
    import Offers from './pages/Offers.vue'
    {
    path: '/offers',
    name: 'Offers',
    component: Offers
    },


Offers.vue a pages-be:

<script> import axios from 'axios'; axios.defaults.baseURL = 'http://localhost:5000/api'; export default { name: "Offers", data() { return { ingatlanok: \\\\\\\[] } }, mounted() { axios.get('/ingatlan') .then(res => { this.ingatlanok = res.data; }) .catch(err => { console.log(err); }); } } \*\*Newad.vue\*\* létrheozás, routeba felvétel, bootstrap mappából template másolása: import Newad from './pages/Newad.vue' \  { \  path: '/newad', \  name: 'Newad', \  component: Newad \  } Home.vue-ba hozzáadni a newad-ot a routerlinkbe A Newad.vue-ban select átírása erre: \*\*script:\*\* import axios from 'axios'; export default { \  name: "Newad", \  data() { \  return { \  kategoriak: \\\[], \  ujIngatlanUrlap: { \  kategoriaId: 0, \  hirdetesDatuma: new Date().toISOString().substring(0, 10), //aktuális dátum és idő, substring = első 10 karakter: év, elválasztó, hónap, elválasztó, nap \  leiras: '', \  tehermentes: false, \  kepUrl: '' \  }, \  hibaUzenet: "" \  } \  }, \  mounted() { \  axios.get('/kategoria') \  .then(res => { \  this.kategoriak = res.data; \  }) \  .catch(err => { \  console.log(err); \  }); \  }, \  methods: { \  mentes() { \  axios.post('/ujingatlan', this.ujIngatlanUrlap) //fenti objektumot postoljuk \  .then(() => { \  this.$router.push('/offers'); \  }) \  .catch(err => { \  this.hibaUzenet = err + " "; \  }); \  } \  } } \*\*option\*\*okben törlés, helyette: \  Kérem válasszon \  {{ kategoria.megnevezes }} Minden inputba name helyett v-model Küldés gombhoz: @click="mentes" ALerthez: v-if="hibaUzenet.length > 0" és {{ hibaUzenet}} **A végén törlés**: nodemodules mappa törlés, zip-be tömrítés
