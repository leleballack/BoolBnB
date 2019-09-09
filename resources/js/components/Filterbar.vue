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
      <div class="col-lg-auto">
        <p class="search__select--title">N° min. stanze</p>
        <select @change="roomsNumberChanged" v-model="selectedRoomsNumber" class="search__select">
          <option value disabled>-------</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
      </div>

      <div v-if="selectedCity !== ''" class="col-lg-auto">
        <p class="search__select--title">Radius</p>
        <select @change="radiusChanged" v-model="selectedRadius" class="search__select">
          <option value disabled>-------</option>
          <option value="20">20km</option>
          <option value="40">40km</option>
          <option value="60">60km</option>
          <option value="80">80km</option>
          <option value="100">100km</option>
          <option value="120">120km</option>
          <option value="200">200km</option>
          <option value="500">500km</option>
        </select>
      </div>

      <div class="col-lg-auto">
        <p class="search__select--title">N° min. posti letto</p>
        <select @change="bedsNumberChanged" v-model="selectedBedsNumber" class="search__select">
          <option value disabled>-------</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </select>
      </div>
    </div>
    <div class="container">
      <div class="row search__resetbtn justify-content-center">
        <button @click="filterReset" class="btn btn-danger mb-2">Resetta filtri</button>
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
    });

    this.fetchServices();
  },

  methods: {
    servicesArrayWasChanged() {
      eventBus.$emit("servicesArrayWasChanged", this.selectedServices);
    },

    radiusChanged() {
      eventBus.$emit("radiusChanged", this.selectedRadius);
    },

    roomsNumberChanged() {
      eventBus.$emit("roomsNumberChanged", this.selectedRoomsNumber);
    },

    bedsNumberChanged() {
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

<style>
</style>