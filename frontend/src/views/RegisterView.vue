<template>

<div class="row justify-content-center mt-5">

<div class="col-md-4">

<div class="card bg-dark text-light shadow border-0">

<div class="card-body p-4">

<h3 class="text-info text-center mb-4">
Registracija
</h3>

<form @submit.prevent="register">

<input
v-model="name"
class="form-control mb-3 bg-secondary text-light border-0"
placeholder="Ime"
/>

<input
v-model="email"
type="email"
class="form-control mb-3 bg-secondary text-light border-0"
placeholder="Email"
/>

<input
v-model="password"
type="password"
class="form-control mb-3 bg-secondary text-light border-0"
placeholder="Lozinka"
/>

<button class="btn btn-info w-100">
Registruj se
</button>

</form>

</div>

</div>

</div>

</div>

</template>

<script>

import axios from 'axios'

export default {

data() {

return {

name: '',
email: '',
password: ''

}

},

methods: {

async register() {

await axios.post(

'http://localhost:8000/api/register',

{

name: this.name,
email: this.email,
password: this.password

}

)

this.$router.push('/login')

}

}

}

</script>