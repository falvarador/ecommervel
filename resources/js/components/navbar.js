class Navbar extends HTMLElement {
    #burger;
    #menu;

    constructor() {
        super();
    }

    connectedCallback() {
        this.#burger = this.querySelector('.navbar-burger');
        this.#menu = this.querySelector('.navbar-menu');

        this.#burger.addEventListener("click", this);
    }

    disconnectedCallback() {
        this.#burger.removeEventListener("click", this);
    }

    handleEvent(event) {
        if (event.type === "click") this.#handleClick();
    }

    #handleClick() {
        this.#burger.classList.toggle('is-active');
        this.#menu.classList.toggle('is-active');
    }
  }

  customElements.define('navbar-element', Navbar);