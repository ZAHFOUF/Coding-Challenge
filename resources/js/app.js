import './bootstrap';

import {createApp} from 'vue'

import router from './router';

import Layout from '../views/pages/layout.vue'

// create the app
const app = createApp(Layout)
app.use(router).mount("#app")
