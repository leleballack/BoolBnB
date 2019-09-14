<template>
  <div class="container">
    <div v-if="(apartamentList.length > 0)">
      <div class="row apartament" v-for="apartament in apartamentList" :key="apartament.id">
        <div
          class="col-lg-4 apartament__image-container"
          v-bind:style="{ 'background-image': 'url(/storage/' + apartament.image_url + ')' }"
        ></div>

        <div class="col-lg-8 apartament__features-container">
          <a
            :href="`/apartaments/${apartament.id}`"
            class="apartament__title heading--tertiary heading--transparent"
          >{{ apartament.title }}</a>

          <div class="row mt-2">
            <div class="col-lg-6 col-xs-12">
              <p class="apartament__feature">
                <i class="fas fa-door-open apartament__icon"></i>
                Numero stanze: {{ apartament.total_rooms }}
              </p>
            </div>
            <div class="col-lg-6 col-xs-12">
              <p class="apartament__feature">
                <i class="fas fa-bed apartament__icon"></i>
                Numero letti: {{ apartament.total_beds }}
              </p>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-lg-6 col-xs-12">
              <p class="apartament__feature">
                <i class="fas fa-shower apartament__icon"></i>
                Numero bagni: {{ apartament.total_baths }}
              </p>
            </div>
            <div class="col-lg-6 col-xs-12">
              <p class="apartament__feature">
                <i class="fas fa-home apartament__icon"></i>
                M. quadri: {{ apartament.square_meters }}
              </p>
            </div>
          </div>

          <div class="row mt-2">
            <div class="col-lg-12 col-xs-12">
              <i class="fas fa-map-marker-alt apartament__icon"></i>
              {{ apartament.address }}
            </div>
          </div>
          <a
            class="btn btn-primary apartament__link"
            :href="`/apartaments/${apartament.id}`"
          >Dettagli</a>
        </div>

        <span v-if="sponsored.includes(apartament.id)" class="apartament__sponsorization">s</span>
      </div>

      <nav>
        <ul class="pagination mt-5 mb-5">
          <li :class="[{ disabled: !pagination.prevPage }]" class="page-item">
            <a
              @click="fetchFromDb(pagination.prevPage)"
              class="page-link"
              href="#search_start_point"
              tabindex="-1"
            >Precedente</a>
          </li>
          <li class="page-item">
            <span class="page-link">{{ pagination.currentPage }} di {{ pagination.lastPage }}</span>
          </li>

          <li :class="[{ disabled: !pagination.nextPage }]" class="page-item">
            <a
              @click="fetchFromDb(pagination.nextPage)"
              class="page-link"
              href="#search_start_point"
            >Successiva</a>
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
      sponsored: [],
      roomsNumber: "",
      bedsNumber: ""
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

    eventBus.$on("roomsNumberChanged", data => {
      this.roomsNumber = data;
      this.fetchFromDb();
    });

    eventBus.$on("bedsNumberChanged", data => {
      this.bedsNumber = data;
      this.fetchFromDb();
    });

    eventBus.$on("filterReset", data => {
      this.currentSelectedCity = data.selectedCity;
      this.selectedServices = data.selectedServices;
      this.currentRadius = data.selectedRadius;
      this.roomsNumber = data.selectedRoomsNumber;
      this.bedsNumber = data.selectedBedsNumber;
      this.fetchFromDb();
    });

    // fetches everything when component is created( first page load )
    this.fetchFromDb();
  },

  methods: {
    filterOnDbWithCity(page) {
      page = page || "/api/filtered";

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
                ...(this.selectedServices
                  ? { services: this.selectedServices }
                  : []),
                ...(this.bedsNumber ? { beds: this.bedsNumber } : ""),
                ...(this.roomsNumber ? { rooms: this.roomsNumber } : "")
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
            services: this.selectedServices,
            ...(this.bedsNumber ? { beds: this.bedsNumber } : ""),
            ...(this.roomsNumber ? { rooms: this.roomsNumber } : "")
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

<style lang="scss" scoped>
</style>