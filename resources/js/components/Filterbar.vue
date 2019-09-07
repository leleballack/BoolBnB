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

    <div class="row search__container" v-if="selectedCity !== ''">
      <select @change="radiusChanged" v-model="selected" class="search__select">
        <option value="20">20km</option>
        <option value="40">40km</option>
        <option value="60">60km</option>
        <option value="80">80km</option>
        <option value="100">100km</option>
      </select>
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
      selected: ""
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
      eventBus.$emit("radiusChanged", this.selected);
    },

    fetchServices() {
      axios
        .get("/api/services")
        .then(res => {
          this.services = res.data;
          console.log(this.services);
        })
        .catch(err => console.log(err));
    }
  }
};
</script>

<style>
</style>