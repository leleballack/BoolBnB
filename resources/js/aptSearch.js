import Vue from "Vue";
import vSelect from "vue-select";
import Search from "./components/Search";

export const eventBus = new Vue({});

Vue.component("v-select", vSelect);

new Vue({
    el: "#search",
    render: h => h(Search)
});
