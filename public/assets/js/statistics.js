import { Doctor } from "./class/Doctor.js";
import { updateNavBar, removeDivFeedback } from "./functions.js";

updateNavBar();
removeDivFeedback();

const doctors = doctorsPHP.map(doctor => new Doctor(doctor));

/* #####    AGE CHART    #####*/
const chartAge = document.querySelector("#chartAge");
const dataAge = {
        labels: ['age < 25', '25 ≤ age ≤ 50', 'age > 50'],
        datasets: [{
            label: "Nombre d'hommes",
            data: tabStats.M,
            borderWidth: 2
        },
        {
            label: "Nombre de femmes",
            data: tabStats.F,
            borderWidth: 2
        }]
    };
new Chart(chartAge, {
    type: 'bar',
    data: dataAge,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
      }
    }
  });

/*#####    DOCTOR CHART    ####*/
const chartDoctor = document.querySelector("#chartDoctor");
const dataDoctor = {
    labels: doctors.map(doctor => doctor.getLegend()),
    datasets: [{
        label: "Durée totale des consultations effectuées (en heures)",
        data: doctors.map(doctor => doctor.duration),
        borderWidth: 2
    }]
}
new Chart(chartDoctor, {
    type: 'bar',
    data: dataDoctor
  });