import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
import AboutView from '../views/AboutView.vue'
import Contact from '../views/Contact.vue'
import ProductView from '../views/ProductView.vue'
import EventView from '../views/EventView.vue'
import Partnership from '../views/Partnership.vue'
import Shop from '../views/Shop.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/about',
      name: 'about',
      component: AboutView,
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact,
    },
    {
      path: '/product',
      name: 'product',
      component: ProductView,
    },
    {
      path: '/event',
      name: 'event',
      component: EventView,
    },
    {
      path: '/partnership',
      name: 'partnership',
      component: Partnership,
    },
    {
      path: '/shop',
      name: 'shop',
      component: Shop,
    },
  ],
})

export default router