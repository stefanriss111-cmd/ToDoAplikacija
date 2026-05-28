<template>

  <div
    class="min-vh-100"
    :class="darkMode
      ? 'bg-black text-light'
      : 'bg-light text-dark'"
  >

    <nav
      class="navbar navbar-expand-lg border-bottom"
      :class="darkMode
        ? 'navbar-dark bg-dark border-secondary'
        : 'navbar-light bg-white border-light'"
    >

      <div class="container">

        <span class="navbar-brand fw-bold text-info">
          Task Manager
        </span>

        <div class="navbar-nav ms-auto align-items-center">

          <router-link
            to="/"
            class="nav-link"
          >
            Zadaci
          </router-link>

          <router-link
            to="/login"
            class="nav-link"
          >
            Prijava
          </router-link>

          <router-link
            to="/register"
            class="nav-link"
          >
            Registracija
          </router-link>

          <button
            class="btn btn-sm btn-outline-info ms-3"
            @click="toggleDarkMode"
          >
            {{ darkMode ? 'Light Mode' : 'Dark Mode' }}
          </button>

          <button
            class="btn btn-danger btn-sm ms-2"
            @click="logout"
          >
            Logout
          </button>

        </div>

      </div>

    </nav>

    <router-view />

  </div>

</template>

<script>

export default {

  data() {

    return {

      darkMode: true

    }

  },

  provide() {

    return {

      darkMode: this

    }

  },

  methods: {

    toggleDarkMode() {

      this.darkMode = !this.darkMode

    },

    logout() {

      localStorage.removeItem('user')

      this.$router.push('/login')

    }

  }

}

</script>