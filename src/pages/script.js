window.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector(`form`);
    const passwordInput = document.querySelector(`input#current-password`);
    const signinButton = document.querySelector(`button#signin`);
    const togglePassButton = document.querySelector(`button#toggle-password`);
  
    // Toggling Password
    togglePassButton.addEventListener(`click`, togglePassword);
  
    function togglePassword() {
      if (passwordInput.type === `password`) {
        passwordInput.type = `text`;
        togglePassButton.textContent = `Hide Password`;
        togglePassButton.setAttribute(`aria-label`, `Hide password`);
      } else {
        passwordInput.type = `password`;
        togglePassButton.textContent = `Show Password`;
        togglePassButton.setAttribute(
          `aria-label`,
          `Show passsword as plain text. Warning: this will display your password on the screen!`
        );
      }
    }
  
    // Validate Password
    passwordInput.addEventListener(`input`, validatePassword);
  
    function validatePassword() {
      let message = ``;
      if (!/.{8,}/.test(passwordInput.value)) {
        message = `At least eight charachters.`;
      }
  
      if (!/.*[A-Z].*/.test(passwordInput.value)) {
        message = `At least one uppercase letter`;
      }
  
      if (!/.*[a-z].*/.test(passwordInput.value)) {
        message = `At least one lowercase letter`;
      }
    }
  
    // Submit Form Validation
    form.addEventListener(`submit`, handleFormSubmit);
  
    function handleFormSubmit() {
      console.log(`submit`);
      if (form.checkValidity() === false) {
        console.log(`not valid`);
        event.preventDefault();
      } else {
        signinButton.disabled = `true`;
        event.preventDefault();
      }
    }
  });
  