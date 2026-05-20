<template>
  <div class="row justify-content-center mt-5">
    <div class="col-md-4">
      <div class="card bg-secondary text-light border-0 shadow">
        <div class="card-body p-4">
          <h3 class="text-center mb-4 text-info">Prijava na sistem</h3>
          <form @submit.prevent="handleLogin">
            <div class="mb-3">
              <label class="form-label">Email adresa</label>
              <input type="email" v-model="email" class="form-control bg-dark text-light border-secondary" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Lozinka</label>
              <input type="password" v-model="password" class="form-control bg-dark text-light border-secondary" required>
            </div>
            <button type="submit" class="btn btn-info w-100 fw-bold text-dark mt-2">Prijavi se</button>
          </form>
          <p v-if="error" class="text-danger text-center mt-3 small">{{ error }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      error: null
    }
  },
  methods: {
    async handleLogin() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', {
          email: this.email,
          password: this.password
        });
        localStorage.setItem('user', JSON.stringify(response.data.user));
        this.$router.push('/');
      } catch (err) {
        this.error = 'Pogrešan email ili lozinka.';
      }
    }
  }
}
</script>