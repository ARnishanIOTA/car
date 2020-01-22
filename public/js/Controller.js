import UI from './UI.js';
export default class Controller {
    constructor() {
        this.ui = new UI();
    }

    // This method makes post request to the api and handles returned response
    post(data){
        fetch('http://carworkshop.to/appointments/create', {
            method: 'POST',
            headers: {
                'Content-type' : 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(res => res.json())
            .then(data => {

                // checking if there were any errors sent back
                if (data.success){
                    this.ui.success();
                }else {
                    // iterating through the errors
                    Object.keys(data.err).forEach(errMsg => {
                       let elem;

                       // getting the element of error
                       if (errMsg === 'mechanic'){
                           elem = document.querySelector(`form select[name=${errMsg}]`);
                       }else if (errMsg === 'date'){
                            elem = document.querySelector('form .appointment-date');
                       } else {
                           elem = document.querySelector(`form input[name=${errMsg}]`);
                       }

                       // Calling method to show the error
                       this.ui.showError(elem, data.err[errMsg]);
                    });
                }
            })
            .catch(err => console.log(err));
    }

    // This method validates user inputs
    validateInput(elem){

        // checking if the input field is empty and if there are any message not shown
        if (elem.value === '' && elem.nextElementSibling.nextElementSibling.tagName !== 'SPAN'){
            let name;
            if (elem.name === 'name'){
                name = 'Name';
            }else if (elem.name === 'address'){
                name = 'Address';
            }else if (elem.name === 'phone'){
                name = 'Phone';
            }else if (elem.name === 'engineNo'){
                name = 'Engine No';
            }else if (elem.name === 'licenseNo'){
                name = 'License No';
            }
            this.ui.showError(elem, `${name} can not be empty`);
        }else if (elem.value !== '' && elem.nextElementSibling.nextElementSibling.tagName === 'SPAN'){
            this.ui.clearError(elem.nextElementSibling.nextElementSibling);
        }
    }

    // This method validates date
    validateDate(day, month, year, elem){
        let date = `${month}-${day}-${year}`;
        date = new Date(date);
        const today = new Date();
        today.setHours(0);
        today.setMinutes(0);
        today.setSeconds(0);
        today.setMilliseconds(0);

        // checking if date is valid
        if (date.getTime() >= today.getTime()){
            // checking if there are any error shown
            if (elem.nextElementSibling.tagName === 'SPAN'){
                // calling method to clear error message
                this.ui.clearError(elem.nextElementSibling);
            }

            // if date is valid, check if mechanic has a value
            const mechanic = document.querySelector('form select[name=mechanic]');
            if (mechanic.value !== ''){
                // if mechanic has value, then validate mechanic
                this.validateMechanic(mechanic, `${year}-${month}-${day}`);
            }
        }else {
            // invalid date. calling method to show error
            this.ui.showError(elem,'Invalid date');
        }
    }

    // This method validates mechanic
    validateMechanic(elem, date){
        // checking if there is any existing error
        if (elem.nextElementSibling.nextElementSibling.tagName === 'SPAN'){
            // clearing existing error from the dom
            this.ui.clearError(elem.nextElementSibling.nextElementSibling);
        }

        // checking if the mechanic is empty
        if (elem.value === ''){
            // showing error
            this.ui.showError(elem, 'You have to select a mechanic');
        }else {
            fetch(`http://carworkshop.to/appointments/validateMechanic/${elem.value}/${date}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.response){
                        this.ui.showError(elem, `${elem.value} is not available on that day`);
                    }
                });
        }
    }
}