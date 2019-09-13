require("./bootstrap");

// da spostare in un js a parte, e importare il modulo qua dentro !!!
$(document).ready(function() {
    $(window).on("resize", function() {
        if ($(window).width() > 767) {
            $(".phone-menu").removeClass("phone-menu--opened");
            $(".spaghetti").removeClass("spaghetti--cooked");
            $(".overlay").removeClass("overlay--active");
        }
    });

    $(".phone-menu, .header").click(function(e) {
        e.stopPropagation();
    });

    $(document).click(function() {
        $(".phone-menu").removeClass("phone-menu--opened");
        $(".overlay").removeClass("overlay--active");
        $(".spaghetti").removeClass("spaghetti--cooked");
    });

    $(".spaghetti").click(function(e) {
        e.stopPropagation();
        $(".phone-menu").toggleClass("phone-menu--opened");
        $(".spaghetti").toggleClass("spaghetti--cooked");
        $(".overlay").toggleClass("overlay--active");
    });
});

// import Navmenu from "./partials/Navmenu";

// let phoneNavMenu = new Navmenu();
