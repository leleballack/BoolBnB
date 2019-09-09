<template>
  <div class="container">
    <div v-if="(apartamentList.length > 0)">
      <div class="apartament" v-for="apartament in apartamentList" :key="apartament.id">
        <span class="apartament__title">{{ apartament.title }}</span>
        <p>Numero stanze: {{ apartament.total_rooms }}</p>
        <p>Numero letti: {{ apartament.total_beds }}</p>
        <p>Numero bagni: {{ apartament.total_baths }}</p>

        <span
          v-if="sponsored.includes(apartament.id)"
          class="apartament__sponsorization"
        >Sponsorizzato</span>
      </div>

      <nav>
        <ul class="pagination">
          <li :class="[{ disabled: !pagination.prevPage }]" class="page-item">
            <a
              @click="fetchFromDb(pagination.prevPage)"
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
              @click="fetchFromDb(pagination.nextPage)"
              class="page-link"
              href="#search_start_point"
            >Succ</a>
          </li>
        </ul>
      </nav>
    </div>

    <div v-else>
      <h3>Non ci sono risultati per i filtri applicati!</h3>
    </div>
  </div>
</template>

<script>
import { eventBus } from "../aptSearch.js";
export default {
  data() {
    return {
      apartamentList: [],
      pagination: {},
      apiKey: "z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc",
      currentSelectedCity: "",
      selectedServices: [],
      cur_selected_city_lat: "",
      cur_selected_city_long: "",
      currentRadius: "",
      sponsored: []
    };
  },

  created() {
    eventBus.$on("cityWasChanged", data => {
      this.currentSelectedCity = data;
      this.fetchFromDb();
    });
    eventBus.$on("servicesArrayWasChanged", data => {
      this.selectedServices = data;
      this.fetchFromDb();
    });

    eventBus.$on("radiusChanged", data => {
      this.currentRadius = data;
      this.fetchFromDb();
    });

    // fetches everything when component is created( first page load )
    this.fetchFromDb();
  },

  methods: {
    filterOnDbWithCity(page) {
      page = page || "/api/filtered";

      console.log(page);

      axios
        .get(
          `https://api.tomtom.com/search/2/search/${this.currentSelectedCity}.json?countrySet=ITA&key=${this.apiKey}`
        )
        .then(res => {
          this.cur_selected_city_lat = res.data.results[0].position.lat;
          this.cur_selected_city_long = res.data.results[0].position.lon;

          return axios
            .get(page, {
              params: {
                lat: this.cur_selected_city_lat,
                long: this.cur_selected_city_long,
                radius: this.currentRadius,
                services: this.selectedServices
              }
            })
            .then(res => {
              res.data.data !== undefined
                ? (this.apartamentList = res.data.data)
                : (this.apartamentList = res.data);

              let parameters = {
                currentPage: res.data.current_page || 1,
                lastPage: res.data.last_page || 1,
                prevPage: res.data.prev_page_url,
                nextPage: res.data.next_page_url
              };

              console.log(res.data);

              this.pagination = parameters;
            })
            .catch(err => console.log(err));
        });
    },

    filterOnDbWithoutCity(page) {
      page = page || "/api/filtered";

      axios
        .get(page, {
          params: {
            services: this.selectedServices
          }
        })
        .then(res => {
          res.data.data !== undefined
            ? (this.apartamentList = res.data.data)
            : (this.apartamentList = res.data);

          let parameters = {
            currentPage: res.data.current_page || 1,
            lastPage: res.data.last_page || 1,
            prevPage: res.data.prev_page_url,
            nextPage: res.data.next_page_url
          };

          console.log(res.data);

          this.pagination = parameters;
        })
        .catch(err => console.log(err));
    },

    getSponsoredIDs() {
      axios
        .get("api/sponsored")
        .then(res => (this.sponsored = res.data))
        .catch(err => console.log(err));
    },

    fetchFromDb(page) {
      this.getSponsoredIDs();
      this.currentSelectedCity !== ""
        ? this.filterOnDbWithCity(page)
        : this.filterOnDbWithoutCity(page);
    }
  }
};
</script>