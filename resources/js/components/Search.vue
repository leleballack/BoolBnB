<template>
  <div>
    <search-intro></search-intro>
    <search-filterbar></search-filterbar>
    <search-apartaments></search-apartaments>
  </div>
</template>

<script>
import apartaments from "./Apartaments.vue";
import intro from "./Intro.vue";
import filterbar from "./Filterbar.vue";
export default {
  data() {
    return {};
  },

  methods: {},

  components: {
    searchIntro: intro,
    searchFilterbar: filterbar,
    searchApartaments: apartaments
  }
};
</script>
