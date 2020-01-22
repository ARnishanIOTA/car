import Controller from "./Controller.js";

const form = document.querySelector('form');
const name = document.querySelector('form input[name="name"]');
const address = document.querySelector('form input[name="address"]');
const phone = document.querySelector('form input[name="phone"]');
const engineNo = document.querySelector('form input[name="engineNo"]');
const licenseNo = document.querySelector('form input[name="licenseNo"]');
const appointmentDay = document.querySelector('form select[name="appointmentDay"]');
const appointmentMonth = document.querySelector('form select[name="appointmentMonth"]');
const appointmentYear = document.querySelector('form select[name="appointmentYear"]');
const mechanic = document.querySelector('form select[name="mechanic"]');
const dateElem = document.querySelector('form .appointment-date');
const inputs = document.querySelectorAll('form input');
const controller = new Controller();
const date = [appointmentDay, appointmentMonth, appointmentYear];

form.addEventListener('submit', (e) => {
    e.preventDefault();
    const data = {
        name : name.value,
        address : address.value,
        phone : phone.value,
        engineNo : engineNo.value,
        licenseNo : licenseNo.value,
        appointmentDay : appointmentDay.value,
        appointmentMonth : appointmentMonth.value,
        appointmentYear : appointmentYear.value,
        mechanic : mechanic.value
    };

    controller.post(data);
});

// event listener for inputs
inputs.forEach(elem => {
    elem.addEventListener('blur', e => {
        // calling input validation method
        controller.validateInput(e.target);
    });
});

// change event listener for date
date.forEach(elem => {
    elem.addEventListener('change', (e) => {
        // calling date validation method
        controller.validateDate(appointmentDay.value, appointmentMonth.value, appointmentYear.value, dateElem);
    });
});
// blur event listener for date
date.forEach(elem => {
    elem.addEventListener('blur', (e) => {
        // calling date validation method
        controller.validateDate(appointmentDay.value, appointmentMonth.value, appointmentYear.value, dateElem);
    });
});

// change event listener for mechanic
mechanic.addEventListener('change', (e) => {
    controller.validateMechanic(mechanic, `${appointmentYear.value}-${appointmentMonth.value}-${appointmentDay.value}`);
});
// blur event listener for mechanic
mechanic.addEventListener('blur', (e) => {
    controller.validateMechanic(mechanic, `${appointmentYear.value}-${appointmentMonth.value}-${appointmentDay.value}`);
});
