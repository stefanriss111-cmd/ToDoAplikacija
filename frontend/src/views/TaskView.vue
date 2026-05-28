<template>

  <div
  v-if="user"
  class="container py-5"
>

    <div
      class="card shadow-lg border-0"
      :class="darkMode.darkMode
        ? 'bg-dark text-light'
        : 'bg-white text-dark'"
    >

      <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

          <div>

            <h2 class="text-info mb-1">
              Dobrodošao,
              {{ user.name }}
            </h2>

            <small class="text-secondary">
              {{ user.email }}
            </small>

          </div>

          <span class="badge bg-info text-dark fs-6">

            {{ filteredTasks.length }} Tasks

          </span>

        </div>

        <div class="d-flex gap-3 mb-4">

          <span class="badge bg-info">

            Total:
            {{ tasks.length }}

          </span>

          <span class="badge bg-success">

            Completed:
            {{ tasks.filter(
              t => t.is_completed
            ).length }}

          </span>

          <span class="badge bg-warning text-dark">

            Active:
            {{ tasks.filter(
              t => !t.is_completed
            ).length }}

          </span>

        </div>

        <div class="row g-2 mb-4">

          <div class="col-md-5">

            <input
              v-model="newTask"
              class="form-control border-0"
              :class="inputClass"
              placeholder="Unesi zadatak"
            />

          </div>

          <div class="col-md-3">

            <select
              v-model="newCategory"
              class="form-select border-0"
              :class="inputClass"
            >

              <option>Privatno</option>
              <option>Posao</option>
              <option>Fakultet</option>

            </select>

          </div>

          <div class="col-md-2">

            <input
              type="date"
              v-model="newDate"
              class="form-control border-0"
              :class="inputClass"
            />

          </div>

          <div class="col-md-2">

            <button
              class="btn btn-info fw-bold w-100"
              @click="addTask"
            >
              Add
            </button>

          </div>

        </div>

        <div class="d-flex gap-2 mb-4">

          <button
            class="btn btn-outline-info btn-sm"
            @click="filter = 'all'"
          >
            All
          </button>

          <button
            class="btn btn-outline-warning btn-sm"
            @click="filter = 'active'"
          >
            Active
          </button>

          <button
            class="btn btn-outline-success btn-sm"
            @click="filter = 'completed'"
          >
            Completed
          </button>

        </div>

        <div class="mb-4">

          <input
            v-model="search"
            class="form-control border-0"
            :class="inputClass"
            placeholder="Search task..."
          />

        </div>

        <div
          v-for="task in filteredTasks"
          :key="task.id"
          class="rounded p-3 mb-3"
          :class="darkMode.darkMode
            ? 'bg-secondary'
            : 'bg-light border'"
        >

          <div class="d-flex justify-content-between align-items-center">

            <div class="w-100 me-3">

              <div class="d-flex align-items-center mb-2">

                <input
                  type="checkbox"
                  class="form-check-input me-3"
                  :checked="task.is_completed"
                  @change="toggleComplete(task)"
                />

                <input
                  v-model="task.title"
                  class="form-control border-0"
                  :class="[

                    darkMode.darkMode
                      ? 'bg-dark text-light'
                      : 'bg-white text-dark',

                    task.is_completed
                      ? 'text-decoration-line-through opacity-75'
                      : ''

                  ]"
                />

              </div>

              <div class="d-flex gap-2">

                <span class="badge bg-info">

                  {{ task.category }}

                </span>

                <span
                  v-if="task.due_date"
                  class="badge bg-warning text-dark"
                >

                  {{ task.due_date }}

                </span>

              </div>

            </div>

            <div class="d-flex gap-2">

              <button
                class="btn btn-primary btn-sm"
                @click="updateTask(task)"
              >
                Save
              </button>

              <button
                class="btn btn-danger btn-sm"
                @click="deleteTask(task.id)"
              >
                Delete
              </button>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</template>

<script>

import axios from 'axios'

export default {

  inject: ['darkMode'],

  data() {

    return {

      tasks: [],
      newTask: '',
      newCategory: 'Privatno',
      newDate: '',
      filter: 'all',
      search: '',

      user: JSON.parse(
        localStorage.getItem('user')
      ),

      api: 'http://localhost:8000/tasks'

    }

  },

  computed: {

    inputClass() {

      return this.darkMode.darkMode
        ? 'bg-secondary text-light'
        : 'bg-light text-dark'

    },

    filteredTasks() {

      let filtered = this.tasks

      if (this.filter === 'active') {

        filtered = filtered.filter(
          task => !task.is_completed
        )

      }

      if (this.filter === 'completed') {

        filtered = filtered.filter(
          task => task.is_completed
        )

      }

      if (this.search) {

        filtered = filtered.filter(task =>

          task.title
            .toLowerCase()
            .includes(
              this.search.toLowerCase()
            )

        )

      }

      return filtered

    }

  },

  methods: {

    async getTasks() {

      const response = await axios.get(

        `${this.api}?user_id=${this.user.id}`

      )

      this.tasks = response.data

    },

    async addTask() {

      if (!this.newTask) return

      await axios.post(this.api, {

        user_id: this.user.id,
        title: this.newTask,
        category: this.newCategory,
        due_date: this.newDate

      })

      this.newTask = ''
      this.newDate = ''

      await this.getTasks()

    },

    async updateTask(task) {

      await axios.post(

        `http://localhost:8000/tasks/update/${task.id}`,

        {

          title: task.title,
          is_completed: task.is_completed

        }

      )

      await this.getTasks()

    },

    async toggleComplete(task) {

      task.is_completed = !task.is_completed

      await this.updateTask(task)

    },

    async deleteTask(id) {

      await axios.post(

        `http://localhost:8000/tasks/delete/${id}`

      )

      await this.getTasks()

    }

  },

  mounted() {

    if (!this.user) {

      this.$router.push('/login')

      return

    }

    this.getTasks()

  }

}

</script>