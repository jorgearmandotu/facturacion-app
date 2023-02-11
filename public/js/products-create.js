let costoInput = document.getElementById('costo');
let percentInput = document.getElementById('percent');
let priceInput = document.getElementById('price');

// percentInput.addEventListener('change', () => {
//     console.log('change percent');
//     let costo = costoInput.value;
//     let percent = percentInput.value;
//         priceInput.value = Number(costo)+costo*percent/100;
// });

// costoInput.addEventListener('change', ()=> {
//     let costo = costoInput.value;
//     let percent = percentInput.value;
//     if(costo > 0){
//         priceInput.value = Number(costo)+costo*percent/100;
//     }
// });
function change(){
    let costo = costoInput.value;
    let percent = percentInput.value;
    priceInput.value = Number(costo)+costo*percent/100;
}

function changePrice(){

}
