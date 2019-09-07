<template>
  <div class="container">
    <div v-if="(apartamentList.length > 0)">
      <div class="apartament" v-for="apartament in apartamentList" :key="apartament.id">
        <span class="apartament__title">{{ apartament.title }}</span>
        <p>Numero stanze: {{ apartament.total_rooms }}</p>
        <p>Numero letti: {{ apartament.total_beds }}</p>
        <p>Numero bagni: {{ apartament.total_baths }}</p>
      </div>
    </div>

    <div v-else>
      <h3>Non ci sono risultati per i filtri applicati!</h3>
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
import Qs from "qs";
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
      currentRadius: ""
    };
  },

  created() {
    eventBus.$on("cityWasChanged", data => {
      this.currentSelectedCity = data;

      this.filterOnDbWithCity();
    });
    eventBus.$on("servicesArrayWasChanged", data => {
      this.selectedServices = data;
      if (this.currentSelectedCity !== "") {
        this.filterOnDbWithCity();
      } else {
        this.filterOnDbWithoutCity();
      }
    });

    eventBus.$on("radiusChanged", data => {
      this.currentRadius = data;
      this.filterOnDbWithCity();
    });
  },

  mounted() {
    this.fetchApartaments();
  },

  methods: {
    fetchApartaments(page) {
      page = page || "/api/apartaments";
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
          `https://api.tomtom.com/search/2/search/${this.currentSelectedCity}.json?countrySet=ITA&key=${this.apiKey}`
        )
        .then(res => {
          this.cur_selected_city_lat = res.data.results[0].position.lat;
          this.cur_selected_city_long = res.data.results[0].position.lon;
        })
        .catch(err => console.log(err));
    },

    filterOnDbWithCity() {
      axios
        .get(
          `https://api.tomtom.com/search/2/search/${this.currentSelectedCity}.json?countrySet=ITA&key=${this.apiKey}`
        )
        .then(res => {
          this.cur_selected_city_lat = res.data.results[0].position.lat;
          this.cur_selected_city_long = res.data.results[0].position.lon;

          return axios
            .get(`api/filtered`, {
              params: {
                lat: this.cur_selected_city_lat,
                long: this.cur_selected_city_long,
                radius: this.currentRadius,
                services: this.selectedServices
              }
            })
            .then(res => {
              if (res.data.data !== undefined) {
                this.apartamentList = res.data.data;
              } else {
                this.apartamentList = res.data;
              }

              console.log(this.apartamentList);
            })
            .catch(err => console.log(err));
        });
    },

    filterOnDbWithoutCity() {
      axios
        .get(`api/filtered`, {
          params: {
            services: this.selectedServices
          }
        })
        .then(res => {
          if (res.data.data !== undefined) {
            this.apartamentList = res.data.data;
          } else {
            this.apartamentList = res.data;
          }

          console.log(this.apartamentList);
        })
        .catch(err => console.log(err));
    }
  }
};
</script>