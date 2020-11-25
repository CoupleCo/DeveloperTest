import Home from './components/Home.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';

export default {
	mode: 'hash',
	routes: [
		{
			name: 'home',
			path: '/',
			component: Home
		},
		{
			name: 'login',
			path: '/login',
			component: Login
		},
		{
			name: 'register',
			path: '/register',
			component: Register
		}
	]
}