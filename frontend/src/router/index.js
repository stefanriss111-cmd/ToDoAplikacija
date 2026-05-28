import { createRouter, createWebHistory } from 'vue-router'

import TaskView from '../views/TaskView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'

const router = createRouter({

history: createWebHistory(),

routes: [

{
path: '/',
component: TaskView
},

{
path: '/login',
component: LoginView
},

{
path: '/register',
component: RegisterView
}

]

})

export default router