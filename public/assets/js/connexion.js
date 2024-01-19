document.querySelector("#pwd").addEventListener("focus", e => {
    document.querySelector("span").classList.add("bg-transparent");
});

document.querySelector("#pwd").addEventListener("blur", e => {
    document.querySelector("span").classList.remove("bg-transparent")
});

document.querySelector("span").addEventListener("click", e => {
    const input = e.currentTarget.previousElementSibling;
    if(input.type === "text") {
        input.type = "password";
        e.currentTarget.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
        input.type = "text";
        e.currentTarget.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
});