function lazyLoader(selector, isLoad, textWhenLoad, textAfterLoad) {
    var button = document.querySelector(selector);
    if (button != null) {
        if (!isLoad) {
            button.classList.remove("disabled");
            button.removeAttribute("disabled");
            button.innerHTML = textAfterLoad;
        } else {
            button.classList.add("disabled");
            button.setAttribute("disabled", true);

            button.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ` + textWhenLoad;

        }
    } else {
        console.warn("lazyLoader, no element!");
    }

}


function showToast(container, message, type,) {



    var color = "text-bg-primary";
    switch (type) {
        case 'error':
            color = "text-bg-danger"
            break;
        case 'success':
            color = "text-bg-success"
            break;
        case 'info':
            color = "text-bg-info"
            break;
        case 'warning':
            color = "text-bg-warning"
            break;
        default:
            color = "text-bg-primary"
            break;
    }



    var toast = `
    <div class="toast align-items-center ${color} border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        ${message}
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
    `;

    container.append(toast);
    var toast = new bootstrap.Toast(container.find('.toast'),{
        autohide: true, // Autohide the toast after a certain time (default: true)
        delay: 5000
    }); // Initialize the Toast object
    toast.show();
}


class botstrapToast {

    constructor(container) {
        this.tostContainer = container;
        this.color = "text-bg-primary"
    }

    setMessage(message) {
        this.message = message;
    }

    setAlert(type) {
        switch (type) {
            case error:
                this.color = "text-bg-danger"
                break;
            case success:
                this.color = "text-bg-success"
                break;
            case info:
                this.color = "text-bg-info"
                break;
            case warning:
                this.color = "text-bg-warning"
                break;
            default:
                this.color = "text-bg-primary"
                break;
        }
    }

    build(yourHTML = null) {
        if (yourHTML != null) {
            this.toastHTML = yourHTML;
        } else {
            this.toastHTML = `
            <div class="toast align-items-center ${this.color} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">
                ${this.message}
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>
            `;
        }
    }

    show() {
        this.toastContainer.append(this.toastHTML);
        var toast = new bootstrap.Toast(this.toastContainer.find('.toast'),{
            autohide: true, // Autohide the toast after a certain time (default: true)
            delay: 5000
        }); // Initialize the Toast object
        toast.show();
    }



}

(() => {
    'use strict'
    const storedTheme = localStorage.getItem('theme');
    // getpreferedtheme
    const getPreferredTheme = () => {
        if(storedTheme) {
            return storedTheme
        }
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
    }
    const setTheme = function(theme) {
        if(theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-bs-theme', 'dark')
        } else {
            document.documentElement.setAttribute('data-bs-theme', theme)
        }
    }
    setTheme(getPreferredTheme())
    const showActiveTheme = theme => {
        const activeThemeIcon = document.querySelector('.theme-icon-active')
        const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
        document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
            element.classList.remove('active')
        })
        btnToActive.classList.add('active');

    }
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        if(storedTheme !== 'light' || storedTheme !== 'dark') {
            setTheme(getPreferredTheme())
        }
    })
    window.addEventListener('DOMContentLoaded', () => {
        showActiveTheme(getPreferredTheme())
        document.querySelectorAll('[data-bs-theme-value]').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const theme = toggle.getAttribute('data-bs-theme-value')
                localStorage.setItem('theme', theme)
                setTheme(theme)
                showActiveTheme(theme, true)
            })
        })
    })
})()