<template>
  <section class="home-page-intro">
    <div class="cover" style="background-image: url('img/sfondo-ricerca.png');">
      <div class="cover__text">
        <img class="cover__image" src="img/italy.png" alt="Italy" />
        <!-- 
        <select
          @change="cityWasChanged"
          v-model="selectedCity"
          class="cover__select"
          name="city_select"
          id="selectedCity"
        >
          <option value disabled>- Seleziona città -</option>
          <option value="Milano">Milano</option>
          <option value="Bologna">Bologna</option>
          <option value="Firenze">Firenze</option>
          <option value="Roma">Roma</option>
        </select>-->

        <v-select
          @input="cityWasChanged"
          class="cover__select"
          id="selectedCity"
          v-model="selectedCity"
          :options="['Milano', 'Bologna', 'Firenze', 'Roma']"
        ></v-select>
      </div>
    </div>
  </section>
</template>

<script>
import { eventBus } from "../aptSearch.js";

export default {
  data() {
    return {
      selectedCity: ""
    };
  },

  created() {
    //////////
    eventBus.$on("filterReset", data => {
      this.selectedCity = data.selectedCity;
    });
  },

  methods: {
    cityWasChanged() {
      if (this.selectedCity === null) {
        this.selectedCity = "";
      }
      eventBus.$emit("cityWasChanged", this.selectedCity);
    }
  }
};
</script>

<style lang="scss" scoped>
.home-page-intro {
  .cover {
    height: 70vh;

    &__text {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;

      width: 100vw;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -60%);

      text-align: center;
    }

    &__image {
      height: 35rem;
      width: auto;
    }

    &__select {
      margin-top: 5rem;
      width: 30rem;
      background-color: white;
    }
  }
}
</style>