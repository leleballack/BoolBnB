<template>
  <div class="intro">
    <div class="intro__content">
      <h2 class="intro__text">Scegli il punto di interesse</h2>

      <select
        @change="cityWasChanged"
        v-model="selectedCity"
        class="intro__select"
        name="city_select"
        id="selectedCity"
      >
        <option value="Milano">Milano</option>
        <option value="Bologna">Bologna</option>
        <option value="Firenze">Firenze</option>
        <option value="Roma">Roma</option>
      </select>
    </div>
  </div>
</template>

<script>
import { eventBus } from "../aptSearch.js";

export default {
  data() {
    return {
      selectedCity: " "
    };
  },

  methods: {
    cityWasChanged() {
      eventBus.$emit("cityWasChanged", this.selectedCity);
    }
  }
};
</script>

<style>
</style>