import * as VueRouter from 'vue-router';
import {routes} from './routes';

import { createRouter } from 'vue-router'

const router = createRouter({
    history: VueRouter.createWebHistory(),
    routes,
})
export default router;
