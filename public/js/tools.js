function messages(icon, title, button, timer){
    Swal.fire({
        //position: 'center',
        type: icon,
        title: title,
        showConfirmButton: button,
        timer: timer
      })

}


// window.addEventListener("keydown", (e) => {
//     if(e.key == "Enter"){
//         e.preventDefault();
//         return false;
//     }
// });
