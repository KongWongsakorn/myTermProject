const container = document.querySelector(".container"),
    register = document.querySelector(".register-link"),
    login = document.querySelector(".login-link");

    //Code register & log in
    register.addEventListener("click",() => {
        container.classList.add("active");
    });
    login.addEventListener("click",() => {
        container.classList.remove("active");
    });