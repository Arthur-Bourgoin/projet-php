export class User {
   
    idUser;
    picturePath;
    secuNumber;
    civility;
    lastName;
    firstName;
    city;
    postalCode;
    address;
    birthDate;
    birthPlace;
    referringDoctor;

    /**
     * Creates an instance of User.
     * @param {Object} obj
     * @memberof User
     */
    constructor(obj) {
        for (const property in this) {
            this[property] = obj[property];
        }
    }

    updateModalModif() {
        const modal = document.querySelector("#modal-modif");
        console.log(this.idUser);
        modal.querySelector("#idUser").value = this.idUser;
        modal.querySelector("img").src = "/assets/images/" + this.picturePath;
        modal.querySelector("#mbody-name div:nth-of-type(1) input").value = this.civility === "M" ? "Mr." : "Mme.";
        modal.querySelector("#mbody-name div:nth-of-type(2) input").value = this.lastName;
        modal.querySelector("#mbody-name div:nth-of-type(3) input").value = this.firstName;
        modal.querySelector("#mbody-birth div:nth-child(1)").innerText = this.civility === "M" ? "Né le" : "Née le";
        modal.querySelector("#mbody-birth div:nth-child(2) input").value = this.birthDate;
        modal.querySelector("#mbody-birth div:nth-child(4) input").value = this.birthPlace;
        modal.querySelector("#mbody-nir input").value = this.secuNumber;
        modal.querySelector("#mbody-pcode input").value = this.postalCode;
        modal.querySelector("#mbody-city input").value = this.city;
        modal.querySelector("#mbody-address input").value = this.address;
        document.querySelector("#mbody-doctor select option:nth-child(1)").selected = true;
        Array.from(document.querySelector("#mbody-doctor select").options).forEach(opt => {
            if(parseInt(opt.value) === this.referringDoctor)
                opt.selected = true;
        });
    }



}
