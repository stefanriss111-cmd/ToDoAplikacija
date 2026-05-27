<template>

  <div
    :class="darkMode
      ? 'bg-dark text-light'
      : 'bg-light text-dark'"
    class="min-vh-100"
  >

    <nav
      class="navbar navbar-expand-lg border-bottom mb-4"
      :class="darkMode
        ? 'navbar-dark bg-secondary border-secondary'
        : 'navbar-light bg-white border-light'"
    >

      <div class="container">

        <span class="navbar-brand fw-bold text-info">
          Task Manager
        </span>

        <div class="navbar-nav ms-auto">

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

          <button
            class="btn btn-sm btn-outline-info ms-3"
            @click="toggleDarkMode"
          >
            {{ darkMode ? 'Light' : 'Dark' }}
          </button>

        </div>

      </div>

    </nav>

    <div class="container">

      <router-view />

    </div>

  </div>

</template>

<script>

export default {
  mounted() {

  this.$root.darkMode = this.darkMode

},

  data() {

    return {

      darkMode: true

    }

  },

  methods: {

    toggleDarkMode() {

      this.darkMode = !this.darkMode
      this.$root.darkMode = this.darkMode

    }

  }

}

</script>