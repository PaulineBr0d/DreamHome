document.addEventListener("DOMContentLoaded", () => {
    const emailInput = document.getElementById('email');
    if (emailInput) {
        emailInput.addEventListener('change', () => {
            const email = emailInput.value.trim();
            if (!validateEmail(email)) {
                document.querySelector('#isEmailValid').innerHTML = 'Email invalide !';
            }
        });
    }
})
document.addEventListener("DOMContentLoaded", () => {
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('change', () => {
            const password = passwordInput.value.trim();
            if (!validateEmail(password)) {
                document.querySelector('#isPassValid').innerHTML = 'Mot de passe invalide !';
            }
        });
    }
})

document.addEventListener("DOMContentLoaded", () => {
    const confirmPasswordInput = document.getElementById('confirm-password');
    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('change', () => {
            const confirmPassword = confirmPasswordInput.value.trim();
            if (!validateEmail(confirmPassword)) {
                document.querySelector('#isPassSame').innerHTML = 'Mots de passe non identiques !';
            }
        });
    }
})

function validatePass(pass) {
    let reg = (/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/);
    return reg.test(pass);
}

function validateEmail(email) {
    let reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return reg.test(email);
}
  
// A faire sur select ?
document.addEventListener("DOMContentLoaded", () => {
    const titleInput = document.getElementById('title');
    if (titleInput) {
        titleInput.addEventListener('change', () => {
            const title = titleInput.value.trim();
            if (title.length > 26 || title.length < 5) {
            document.querySelector('#isTitleValid').innerHTML = 'Le titre doit être comprise entre 5 et 25 caractères.';
         }
        });
    }
})
//ne fontionne pas => à revoir
document.addEventListener("DOMContentLoaded", () => {
    const priceInput = document.getElementById('price');
    if (priceInput) {
        priceInput.addEventListener('change', () => {
            const price = priceInput.value.trim();
            if (!isInteger(price) || price < 0) {
             document.querySelector('#isPriceValid').innerHTML = 'Le prix doit être un nombre positif.'
            }
        });
    }
})

document.addEventListener("DOMContentLoaded", () => {
    const locationInput = document.getElementById('location');
    if (locationInput) {
        locationInput.addEventListener('change', () => {
            const location = locationInput.value.trim();
            if (location.length > 26 || location.length < 3) {
            document.querySelector('#isLocationValid').innerHTML = 'Le nom de la ville doit être comprise entre 3 et 25 caractères.'
            }
        });
    }
})
  
document.addEventListener("DOMContentLoaded", () => {
    const descriptionInput = document.getElementById('description');
    if (descriptionInput) {
        descriptionInput.addEventListener('change', () => {
            const description = descriptionInput.value.trim();
            if (description.length > 101 || description.length < 25) {
            document.querySelector('#isDescriptionValid').innerHTML = 'La description doit être comprise entre 25 et 100 caractères.'
            } 
        });
    }
})


     
