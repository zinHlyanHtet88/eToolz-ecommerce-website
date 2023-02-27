<template>
    <div class="pagination ">
      <button v-if="currentPage > 1" @click="updatePage(currentPage - 1)" class="text-danger">Previous</button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button v-if="currentPage < totalPages" @click="updatePage(currentPage + 1)">Next</button>
    </div>
  </template>

  <script>
  export default {
    name: 'Pagination',

    props: {
      items: {
        type: Array,
        required: true,
      },
      perPage: {
        type: Number,
        default: 10,
      },
    },

    data() {
      return {
        currentPage: 1,
      }
    },

    computed: {
      totalPages() {
        return Math.ceil(this.items.length / this.perPage)
      },
      displayedItems() {
        const start = (this.currentPage - 1) * this.perPage
        const end = start + this.perPage
        return this.items.slice(start, end)
      },
    },

    methods: {
      updatePage(page) {
        this.currentPage = page
      },
    },
  }
  </script>
