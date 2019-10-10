//IMPORT SECTION
import Vue from 'vue'
import Router from 'vue-router'
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import store from './store.js'
import IndexTravel from './pages/travels/Index.vue'
import DataTravel from './pages/travels/Travel.vue'
import AddTravel from './pages/travels/Add.vue'
import EditTravel from './pages/travels/Edit.vue'

Vue.use(Router)

//DEFINE ROUTE
const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: { requiresAuth: true }
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/travels',
            component: IndexTravel,
            children: [
                {
                    path: '',
                    name: 'travels.data',
                    component: DataTravel,
                    meta: { title: 'Manage Travels' }
                },
                {
                    path: 'add',
                    name: 'travels.add',
                    component: AddTravel,
                    meta: { title: 'Add New Travel' }
                },
                {
                    path: 'edit/:id',
                    name: 'travels.edit',
                    component: EditTravel,
                    meta: { title: 'Edit Travel' }
                }
            ]
        }
    ]
});

//Navigation Guards
router.beforeEach((to, from, next) => {
    store.commit('CLEAR_ERRORS')
    if (to.matched.some(record => record.meta.requiresAuth)) {
        let auth = store.getters.isAuth
        if (!auth) {
            next({ name: 'login' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router