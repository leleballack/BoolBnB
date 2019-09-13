<template>
  <div class="container-fluid search">
    <div class="row search__container" id="search_start_point">
      <label
        v-for="service in services"
        :key="service.id"
        :for="service.id"
        class="form-check-label search__checkbox--label"
      >
        <input
          @change="servicesArrayWasChanged"
          type="checkbox"
          :id="service.id"
          :value="service.id"
          class="search__checkbox--quad"
          v-model="selectedServices"
        />
        {{ service.description }}
      </label>
    </div>

    <div class="row search__container">
      <div class="col-lg-auto search__istance">
        <p class="search__title">N° min. stanze</p>
        <v-select
          @input="roomsNumberChanged"
          class="search__select"
          v-model="selectedRoomsNumber"
          :options="['1', '2', '3', '4', '5']"
        ></v-select>
      </div>

      <div v-if="selectedCity !== ''" class="col-lg-auto search__istance">
        <p class="search__title">Radius</p>

        <v-select
          @input="radiusChanged"
          class="search__select"
          v-model="selectedRadius"
          :options="['20', '40', '60', '80', '100', '120', '200']"
        ></v-select>
      </div>

      <div class="col-lg-auto col-sm-12 search__istance">
        <p class="search__title">N° min. posti letto</p>

        <v-select
          @input="bedsNumberChanged"
          class="search__select"
          v-model="selectedBedsNumber"
          :options="['1', '2', '3', '4', '5', '6', '7', '8']"
        ></v-select>
      </div>
    </div>
    <div class="container">
      <div class="row search__resetbtn-container justify-content-center">
        <button
          @click="filterReset"
          class="button button--blue button--animated search__resetbtn"
        >Resetta filtri</button>
      </div>
    </div>
  </div>
</template>

<script>
import { eventBus } from "../aptSearch.js";

export default {
  data() {
    return {
      services: [],
      selectedServices: [],
      selectedCity: "",
      selectedRadius: "",
      selectedRoomsNumber: "",
      selectedBedsNumber: ""
    };
  },

  created() {
    eventBus.$on("cityWasChanged", data => {
      this.selectedCity = data;
      if (this.selectedCity === "") this.selectedRadius = "";
    });

    this.fetchServices();
  },

  methods: {
    servicesArrayWasChanged() {
      eventBus.$emit("servicesArrayWasChanged", this.selectedServices);
    },

    radiusChanged() {
      if (this.selectedRadius === null) this.selectedRadius = "";
      eventBus.$emit("radiusChanged", this.selectedRadius);
    },

    roomsNumberChanged() {
      if (this.selectedRoomsNumber === null) this.selectedRoomsNumber = "";
      eventBus.$emit("roomsNumberChanged", this.selectedRoomsNumber);
    },

    bedsNumberChanged() {
      if (this.selectedBedsNumber === null) this.selectedBedsNumber = "";
      eventBus.$emit("bedsNumberChanged", this.selectedBedsNumber);
    },

    filterReset() {
      this.selectedServices = [];
      this.selectedCity = "";
      this.selectedRadius = "";
      this.selectedRoomsNumber = "";
      this.selectedBedsNumber = "";

      let changedData = {
        selectedServices: this.selectedServices,
        selectedCity: this.selectedCity,
        selectedRadius: this.selectedRadius,
        selectedRoomsNumber: this.selectedRoomsNumber,
        selectedBedsNumber: this.selectedBedsNumber
      };

      eventBus.$emit("filterReset", changedData);
    },

    fetchServices() {
      axios
        .get("/api/services")
        .then(res => (this.services = res.data))
        .catch(err => console.log(err));
    }
  }
};
</script>

<style lang='scss' scoped>
@import "../../sass/abstracts/_variables.scss";
@import "../../sass/abstracts/_mixins.scss";

.search {
  margin-top: 5rem;
  @include respond(phone) {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  &__container {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    padding: 20px;

    @include respond(phone) {
      width: 80%;
      flex-direction: column;
      align-items: flex-start;
      padding: 1.3rem;
    }
  }

  &__istance {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    &:not(:last-child) {
      margin-bottom: 1.5rem;
    }
  }

  &__select {
    background-color: lighten($color: $main-blue-color, $amount: 60);
    width: 20rem;
    border: 0.5px outset $main-blue-color;

    @include respond(tablet) {
      width: 80%;
    }
    @include respond(phone) {
      width: 100%;
    }
  }

  &__resetbtn {
    margin: 3rem 0 7rem;
  }

  #search_start_point {
    @include respond(phone) {
      width: 60%;
    }
  }
}
</style>