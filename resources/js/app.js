import './bootstrap';

import {createApp} from 'vue'

import Main from '../views/pages/main.vue'


// create the app
const app = createApp(Main)
app.mount("#app")
