class Modal {
    constructor(modalId) {
        this.modal_id = modalId;
        this.modal = document.querySelector(`#${modalId}`);
        this.modal_overlay = this.modal.querySelector('#modal-overlay');
        this.modal_box = this.modal.querySelector('#modal-box');
        this.events();
    }

    events() {
        document.querySelectorAll(`[data-modal-target="#${this.modal_id}"]`).forEach(el => {
            el.addEventListener('click', () => {
                this.openModal();
            });
        });
        this.modal.querySelector(`[data-modal-close="#${this.modal_id}"]`).addEventListener('click', () => {
            this.closeModal();
        });
        document.addEventListener('keyup', (e) => this.keyPressHandler(e));
    }

    keyPressHandler(e) {
        if (e.keyCode === 27) {
            this.closeModal();
        }
    }

    openModal() {
        document.querySelector('body').classList.add('overflow-hidden');
        this.modal.style.display = null;
        this.modal_overlay.style.display = null;
        this.modal_box.style.display = null;
        this.modal_box.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
        this.modal_overlay.classList.add('ease-out', 'duration-300', 'opacity-0');
        setTimeout(() => {
            this.modal_box.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
            this.modal_box.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
            this.modal_overlay.classList.remove('opacity-0');
            this.modal_overlay.classList.add('opacity-100');
            this.modal_box.classList.remove('opacity-100', 'translate-y-0', 'sm:translate-y-0', 'sm:scale-100');
            this.modal_overlay.classList.remove('ease-out', 'duration-300', 'opacity-100');
        }, 200);
    }

    closeModal() {
        document.querySelector('body').classList.remove('overflow-hidden');
        this.modal_box.classList.add('ease-in', 'duration-200', 'opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
        this.modal_overlay.classList.add('ease-in', 'duration-200', 'opacity-0');
        setTimeout(() => {
            this.modal_box.classList.remove('ease-in', 'duration-200', 'opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
            this.modal_overlay.classList.remove('ease-in', 'duration-200', 'opacity-0');
            this.modal.style.display = 'none';
            this.modal_overlay.style.display = 'none';
            this.modal_box.style.display = 'none';
        }, 200);
    }
}

window.modal = Modal
