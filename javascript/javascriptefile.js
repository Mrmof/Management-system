function showpassword(){
    var mypassword = document.getElementById('psw');
    var spanicon = document.getElementById('spanicon');
    if (mypassword.type == 'password') {
        mypassword.type = 'text';
        spanicon.classList.remove('icofont-eye');
        spanicon.classList.add('icofont-eye-blocked');
    } else{
        mypassword.type = 'password';
        spanicon.classList.remove('icofont-eye-blocked');
        spanicon.classList.add('icofont-eye');
    }
}

function formsubmit() {
    event.preventDefault();
    var mypassword = document.getElementById('psw');
    var validatePassword = document.getElementById('validate');
    if (mypassword.value == '') {
        validatePassword.innerHTML = 'Please Input a password';  
        
    }
    if (mypassword.value.length < 8) {
        validatePassword.innerHTML = 'Password too weak. Password must be more than 7 characters'; 
        mypassword.style.border = '2px solid red';
    }
    
    
}