import Vue from "Vue";
import Search from "./components/Search";

export const eventBus = new Vue({});

new Vue({
    el: "#search",
    render: h => h(Search)
});
