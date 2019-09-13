import $ from "jquery";

export default class Navmenu {
    constructor() {
        this.document = $(document);
        this.window = $(window);

        this.navmenu = $(".phone-menu");
        this.navmenuCloser = $(".spaghetti");

        this.events();
    }

    // DOM Events
    events() {
        this.navmenuCloser.click(this.toggleNavMenu.bind(this));
        this.document.on("click", this.closeNavMenu.bind(this));
        this.navmenu.click(this.stopProp.bind(this));
        this.window.on("resize", this.forceNavMenuClosing.bind(this));
    }

    stopProp(e) {
        e.stopPropagation();
    }

    toggleNavMenu(e) {
        console.log("clickato");

        e.stopPropagation();
        $(".phone-menu").toggleClass("phone-menu--opened");
        $(".spaghetti").toggleClass("spaghetti--cooked");
        $(".overlay").toggleClass("overlay--active");
    }

    closeNavMenu() {
        // this.navmenu.removeClass("phone-menu--opened");
        // console.log("ciao");
    }

    forceNavMenuClosing() {
        if (this.window.width() > 767) {
            this.closeNavMenu();
        }
    }
}
