<template>
  <div class="bg-dark text-light min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary border-bottom border-secondary mb-4">
      <div class="container">
        <span class="navbar-brand fw-bold text-info">Task Manager</span>
        <div class="navbar-nav ms-auto">
          <router-link to="/" class="nav-link">Zadaci</router-link>
          <router-link to="/login" class="nav-link">Prijava</router-link>
        </div>
      </div>
    </nav>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>