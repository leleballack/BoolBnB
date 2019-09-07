import Vue from "Vue";
import Search from "./components/Search";

export const eventBus = new Vue({
    // data: {
    //     apiKey: "z4n3yxl4X8bvK1BA6YlSAaYcV7OTbkZc",
    //     selectedCity: ""
    // },
    // methods: {
    //     fetchAndTransformFromTomtom() {
    //         axios
    //             .get(
    //                 `https://api.tomtom.com/search/2/search/Milano.json?countrySet=ITA&key=${this.apiKey}`
    //             )
    //             .then(res => {
    //                 console.log(res);
    //             })
    //             .catch(err => console.log(err));
    //     }
    // }
});

new Vue({
    el: "#search",
    render: h => h(Search)
});
