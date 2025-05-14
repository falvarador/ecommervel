class Form extends HTMLElement {
    #form;
    #token;
    #keepFields;
    #updateURL;
    #removeElem;
    #delay;

    constructor() {
        super();
    }

    connectedCallback() {
        this.#form = this.querySelector('form');
        this.#form.addEventListener("submit", this);
        this.#form.setAttribute("novalidate", "");
        this.#token = this.querySelector('[name="_token"]');

        // Define options
        this.#keepFields = this.hasAttribute('keep-fields');
        this.#updateURL = this.getAttribute('update-url');
        this.#removeElem = this.getAttribute('remove');
        this.#delay = this.hasAttribute('delay') ? 6000 : 0;
    }

    disconnectedCallback() {
        this.#form.removeEventListener("submit", this);
    }

    handleEvent(event) {
        if (event.type === "submit") this.#handleSubmit(event);
    }

    /**
     * Handle submit events
     * @param {Event} event The event object
     * @return {Promise<void>} A promise that resolves when the API call is complete
    */
    async #handleSubmit(event) {
        event.preventDefault();

        // If the form is already submitting, do nothing
        // Otherwise, disable future submissions
        if (this.#isDisabled()) return;
        this.#disable();

        try {

            // Call the API
            const { action, method } = this.#form;
            const response = await fetch(action, {
                method,
                body: this.#serialize(),
                headers: {
                    'Content-type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': this.#token.content,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            // Get the response data
            const data = await response.json();

            // If there's an error, throw
            if (!response.ok) throw data;

            // If updateURL, update it
            if (this.#updateURL) {
                history.replaceState(history.state, null, this.#updateURL);
            }

            // If URL, redirect
            if (data.url) {
                window.location.href = data.url;
            } else {

                // Clear the form
                if (!this.#keepFields) {
                    this.#reset();
                }

                // Emit custom event
                this.#emit(data);

                // Optionally remove all HTML
                if (this.#removeElem) {
                    let elemToRemove = this.closest(this.#removeElem) || this;
                    elemToRemove.remove();
                }
            }


        } catch (error) {
            console.warn(error);
            this.#showStatus(error);
        } finally {
            setTimeout(() => {
                this.#enable();
            }, this.#delay);
        }
    }

    /**
     * Check if a form is submitting to the API
     * @return {Boolean} If true, the form is submitting
     */
    #isDisabled() {
        return this.hasAttribute('form-submitting');
    }

    /**
     * Disable a form so I can't be submitted while waiting for the API
     */
    #disable() {
        this.setAttribute('form-submitting', '');
    }

    /**
     * Enable a form after the API returns
     */
    #enable() {
        this.removeAttribute('form-submitting');
    }

    /**
     * Reset the form element values
     */
    #reset() {
        this.form.reset();
    }

    /**
     * Update the form status in a field
     * @param {Error} error The message to display
     */
    #showStatus(error) {
        if (!error.errors) return;

        let firstInputError = null;

        Object.entries(error.errors).forEach(([key, value]) => {
            const input = this.querySelector(`[name="${key}"]`);
            const inputError = this.querySelector(`[data-error="${key}"]`);

            if (inputError) {
                input.classList.add('is-danger');
                inputError.innerHTML = `<p class="help is-danger" role="alert">${value}</p>`;

                // Get the first input with error
                if (!firstInputError) {
                    firstInputError = input;
                }
            }
        });

        // Focus on the first input with error
        if (firstInputError) {
            firstInputError.focus();
        }
    }

    /**
     * Serialize all form data into an encoded query string
     * @return {String} The serialized form data
     */
    #serialize() {
        const data = new FormData(this.#form);
        const params = new URLSearchParams();

        for (let [key, value] of data) {
            params.append(key, value);
        }

        return params.toString();
    }

    /**
     * Emit a custom event
     * @param  {Object} detail Any details to pass along with the event
     */
    #emit(detail = {}) {

        // Create a new event
        let event = new CustomEvent('form-ajax-submit', {
            bubbles: true,
            cancelable: false,
            detail: detail
        });

        // Dispatch the event
        return this.dispatchEvent(event);

    }
}

customElements.define('form-element', Form);
