import Vue from "Vue";
import Search from "./components/Search";

// $(document).ready(function() {
//     $(".search__select, .intro__select").select2();
// });

new Vue({
    el: "#search",
    render: h => h(Search)
});
