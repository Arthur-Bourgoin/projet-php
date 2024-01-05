export function updateNavBar() {
    document.querySelectorAll("ul a").forEach(a => {
        a.classList.remove("active");
        if(a.href.split("/").pop() === window.location.pathname.substring(1))
            a.classList.add("active");
    });
}

export function removeDivFeedback() {
    const divAlert = document.querySelector(".divFeedback");
    if(divAlert) {
        setTimeout(() => {
            divAlert.style.opacity = 1;
            const interval = setInterval(() => {
                divAlert.style.opacity -= 0.01;
                if(divAlert.style.opacity <= 0) {
                    clearInterval(interval);
                    divAlert.remove();
                }
            }, 10);
        }, 5000);
    }
}

function eyeOnClick(e) {
    const input = e.currentTarget.previousElementSibling;
    if(input.type === "text") {
        input.type = "password";
        e.currentTarget.innerHTML = '<i class="bi bi-eye"></i>';
    }
    else {
        input.type = "text";
        e.currentTarget.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
}

export function eventChangePicture(input, img) {
    document.querySelector(input).addEventListener("input", e => {
        const reader = new FileReader();
        reader.onload = e => document.querySelector(img).src = e.target.result
        reader.addEventListener('progress', e => {
            if (e.loaded && e.total)
              console.log("Progress: " + Math.round((e.loaded / e.total) * 100));
          });    
        reader.readAsDataURL(e.currentTarget.files[0]);
    });
}