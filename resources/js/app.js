require('./bootstrap');
import { createApp } from 'vue'
import router from './router/index'
import store from './store/index';

// import the root component App from a single-file component.
import App from './App.vue'

const app = createApp(App)

app.use(router);
app.use(store);

app.mount('#app')
