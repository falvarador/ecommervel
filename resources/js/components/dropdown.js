class Dropdown extends HTMLElement {
    #target;
    #action;

    constructor() {
        super();
    }

    connectedCallback() {
        this.#target = this.querySelector('.has-dropdown');
        this.#action = this.querySelector('.navbar-link');

        this.#target.addEventListener("click", this);
    }

    disconnectedCallback() {
        this.#target.removeEventListener("click", this);
    }

    handleEvent(event) {
        if (event.type === "click") this.#handleClick();
    }

    #handleClick() {
        this.#target.classList.toggle('is-active');
    }
  }

  customElements.define('dropdown-element', Dropdown);