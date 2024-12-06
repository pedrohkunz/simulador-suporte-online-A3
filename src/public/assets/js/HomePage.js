const increment = () => {
    let input = document.getElementById('numberOfAttendantsValue');

    if(input.value == '') {
        input.value = 0;
    }

    let currentValue = parseInt(input.value);

    if(currentValue == 100){
        return
    }

    input.value = currentValue + 1;
}

const decrement = () => {
    let input = document.getElementById('numberOfAttendantsValue')

    if(input.value == '') {
        input.value = 0;
    }

    let currentValue = parseInt(input.value)

    if (currentValue > 1) {
        input.value = currentValue - 1
    }

}

const verifyValue = () => {
    let input = document.getElementById('numberOfAttendantsValue')

    if(input.value == '') {
        alert('O número de atendentes não pode ser vazio')
    }

    let currentValue = parseInt(input.value)
    
    if(currentValue > 100) {
        alert('O número de atendentes não pode ser maior que 100')
    }

    if(currentValue < 1) {
        alert('O número de atendentes não pode ser menor que 1')
    }
}

const startSimulation = () => {
    let input = document.getElementById('numberOfAttendantsValue')

    if(input.value == '') {
        alert('O número de atendentes não pode ser vazio')
    }

    let numberOfAttendants = parseInt(input.value)
    
    if(numberOfAttendants > 100) {
        alert('O número de atendentes não pode ser maior que 100')
    }

    if(numberOfAttendants < 1) {
        alert('O número de atendentes não pode ser menor que 1')
    }

    window.location.href = `./Simulation.php?numberOfAttendants=${numberOfAttendants}`;
}
