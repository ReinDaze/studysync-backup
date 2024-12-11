import { createRouter, createWebHistory } from 'vue-router';
import Login from '@/Pages/Auth/Login.vue';
import Register from '@/Pages/Auth/Register.vue';
import HomeView from '@/Pages/HomeView.vue';
import Dashboard from '@/Pages/Dashboard.vue';

const routes = [
  {
      path: '/',
      name: 'Home',
      component: HomeView,
  },
  {
      path: '/login',
      name: 'login',
      component: Login,
  },
  {
      path: '/dashboard',
      name: 'Dashboard',
      component: Dashboard,
  },
  {
      path: '/register',
      name: 'register',
      component: Register,
  },
];
const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
