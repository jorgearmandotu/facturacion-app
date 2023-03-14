function messages(icon, title, button, timer){
    Swal.fire({
        //position: 'center',
        type: icon,
        title: title,
        showConfirmButton: button,
        timer: timer
      })

}

let btnSubmit = document.querySelector('#submit');
let btnSubmitForm = document.querySelector('#btnSubmit');

if(btnSubmit){
    btnSubmit.addEventListener('click', (e)=>{
        e.preventDefault();
        //console.log(document.formSubmit);
    });
}
if(btnSubmitForm){
    btnSubmitForm.addEventListener('click', () => {
        // let formShop = document.querySelector('#formSupplier');
        // if(formShop){
        //     formShop.submit();
        // }
        let form = document.querySelector('#formSubmit');
        form.submit();
    });
}


// window.addEventListener("keydown", (e) => {
//     if(e.key == "Enter"){
//         e.preventDefault();
//         return false;
//     }
// });
