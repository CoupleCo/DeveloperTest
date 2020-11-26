import auth from './middlewares/auth'

import Dashboard from './components/Dashboard.vue'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import CreateTeam from './components/CreateTeam.vue'
import ViewTeam from './components/ViewTeam.vue'

import Router from 'vue-router'

let routes = new Router({
	mode: 'hash',
	routes: [
		{
			name: 'login',
			path: '/login',
			component: Login
		},
		{
			name: 'register',
			path: '/register',
			component: Register
		},
		{
			name: 'dashboard',
			path: '/',
			component: Dashboard,
			meta: {
				requiresAuth: true
			}
		},
		{
			name: 'createTeam',
			path: '/create-team',
			component: CreateTeam,
			meta: {
				requiresAuth: true
			}
		},
		{
			name: 'viewTeam',
			path: '/team/:id',
			component: ViewTeam,
			meta: {
				requiresAuth: true
			}
		}
	]
})

routes.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.requiresAuth)) {
		if (!auth())
			next({
				name: 'login'
			})

		next()
	} else {
		next()
	}
})

export default routes