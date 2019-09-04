<template>
    <div v-if="render" class="container" id="pagination">
    <ul class="pagination">
    <li :class="{ disabled: isInFirstPage, 'page-item' : isInFirstPage}">
      <a class="page-link" 
        type="button" 
        href="#"
        @click="onClickFirstPage"
        aria-label="Go to first page">First</a>
    </li>

    <li :class="{ disabled: isInFirstPage, 'page-item' : isInFirstPage}">
      <a class="page-link" 
        type="button" 
        href="#"
        @click="onClickPreviousPage"
        aria-label="Go to previous page">Pre</a>
    </li>

    <li v-for="page in pages" :key="page" :class="{ active: isPageActive(page.name) }">
      <a
        type="button" 
        href="#"
        @click="onClickPage(page.name)"
        :disabled="page.isDisabled"
        class="page-link"
        :aria-label="`Go to page number ${page.name}`"
        
      >
        {{ page.name }}
      </a>
    </li>

    <li :class="{ disabled: isInLastPage, 'page-item' : isInLastPage}">
      <a 
        type="button" 
        href="#"
        @click="onClickNextPage"
        class="page-link "
        aria-label="Go to next page"
      >
        Next
      </a>
    </li>

    <li :class="{ disabled: isInLastPage, 'page-item' : isInLastPage}">
      <a
        type="button" 
        @click="onClickLastPage"
        class="page-link"
        href="#"
        aria-label="Go to last page"
      >
        Last
      </a>
    </li>
    </ul>
    </div>
</template>

<script>
export default {
    props: {
    maxVisibleButtons: {
      type: Number,
      required: false,
      default: 5
    },
    totalPages: {
      type: Number,
      required: true
    },
    total: {
      type: Number,
      required: true
    },
    currentPage: {
      type: Number,
      required: true
    },
    render: {
        type: Boolean,
        required: true
    }
  },
  computed: {
    startPage() {
      if (this.currentPage === 1) {
        return 1;
      }

      if (this.currentPage === this.totalPages) { 
        return this.totalPages - this.maxVisibleButtons + 1;
      }

      return this.currentPage - 1;

    },
    endPage() {
      
      return Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
      
    },
    pages() {
      const range = [];

      for (let i = this.startPage; i <= this.endPage; i+= 1 ) {
        range.push({
          name: i,
          isDisabled: i === this.currentPage 
        });
      }

      return range;
    },
    isInFirstPage() {
      return this.currentPage === 1;
    },
    isInLastPage() {
      return this.currentPage === this.totalPages;
    },
  },

  methods: {
    onClickFirstPage() {
      this.$emit('pagechanged', 1);
    },
    onClickPreviousPage() {
      this.$emit('pagechanged', this.currentPage - 1);
    },
    onClickPage(page) {
      this.$emit('pagechanged', page);
    },
    onClickNextPage() {
      this.$emit('pagechanged', this.currentPage + 1);
    },
    onClickLastPage() {
      this.$emit('pagechanged', this.totalPages);    
    },
    isPageActive(page) {
      return this.currentPage === page;
    },
  }
 };
</script>

<style>
    #alo {
        background-color: white;
        color: blue;
    }
</style>