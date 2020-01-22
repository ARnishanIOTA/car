export default class UI {
    success(){
        // Display success message
        console.log('success');
        const success = document.getElementById('success');
        success.style.display = 'block';
        setTimeout(() => {
            success.style.display = 'none';
        }, 3000);

        // clearing form values
        const inputs = document.querySelectorAll('form input');
        const mechanic = document.querySelector('form select[name=mechanic]');
        const day = document.querySelector('form select[name=appointmentDay]');
        mechanic.value = '';
        day.value = 1;
        inputs.forEach(e => e.value = '');
    }

    // this method shows error
    showError(elem, msg){
        let span = document.createElement('SPAN');
        let br = document.createElement('BR');
        span.innerText = msg;
        span.className = 'invalid-feedback';

        // showing error message for date
        if (elem.classList.contains('appointment-date')){
            // Checking if the error message is already shown
            if (elem.nextElementSibling.tagName !== 'SPAN'){
                elem.after(br);
                elem.after(span);
            }
        }else {
            // showing error message for other elements

            // Checking if the error message is already shown
            if (elem.nextElementSibling.nextElementSibling.tagName !== 'SPAN'){
                elem.after(span);
                elem.after(br);
            }
        }
    }

    clearError(elem){
        elem.parentElement.removeChild(elem.nextElementSibling);
        elem.parentElement.removeChild(elem);
    }
}