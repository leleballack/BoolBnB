<template>
  <div class="container">
    <div class="apartament" v-for="apartament in apartamentList" :key="apartament.id">
      <span class="apartament__title">{{ apartament.title }}</span>
      <p>Numero stanze: {{ apartament.total_rooms }}</p>
      <p>Numero letti: {{ apartament.total_beds }}</p>
      <p>Numero bagni: {{ apartament.total_baths }}</p>
    </div>

    <nav>
      <ul class="pagination">
        <li :class="[{ disabled: !pagination.prevPage }]" class="page-item">
          <a
            @click="fetchApartaments(pagination.prevPage)"
            class="page-link"
            href="#search_start_point"
            tabindex="-1"
          >Prec</a>
        </li>
        <li class="page-item">
          <p class="page-link">{{ pagination.currentPage }} di {{ pagination.lastPage }}</p>
        </li>

        <li :class="[{ disabled: !pagination.nextPage }]" class="page-item">
          <a
            @click="fetchApartaments(pagination.nextPage)"
            class="page-link"
            href="#search_start_point"
          >Succ</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  data() {
    return {
      apartamentList: [],
      pagination: {},
      apiKey: "z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc"
    };
  },

  mounted() {
    this.fetchApartaments();
  },

  methods: {
    fetchApartaments(page) {
      page = page || "http://127.0.0.1:8000/api/apartaments";
      axios
        .get(page)
        .then(res => {
          let parameters = {
            currentPage: res.data.current_page,
            lastPage: res.data.last_page,
            prevPage: res.data.prev_page_url,
            nextPage: res.data.next_page_url
          };

          console.log(res);

          this.pagination = parameters;
          this.apartamentList = res.data.data;
        })
        .catch(err => console.log(err));
    },

    fetchAndTransformFromTomtom() {
      axios
        .get(
          `https://api.tomtom.com/search/2/search/Milano.json?countrySet=ITA&key=${this.apiKey}`
        )
        .then(res => {
          console.log(res);
        })
        .catch(err => console.log(err));
    }
  }
};
</script>