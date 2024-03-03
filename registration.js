function printerror(Id, Msg) {
    document.getElementById(Id).innerHTML = Msg;
}

function validform() {
    let name = document.FORM.name.value.trim();
    let email = document.FORM.email.value.trim();
    let pnumber = document.FORM.number.value.trim();
    let password = document.FORM.password.value.trim();
    let img = document.FORM.file.value.trim();




    let name_error = email_error = pnumber_error = password_error = img_error  = true
   
   
   
//    ===================== name validation ============================
    if (name == "") {
        printerror("name_error", "blank space not allowed");

    }
    else {
        var regex = /^[a-zA-Z\s]+$/;
        if (regex.test(name) === false) {
            printerror("name_error", "enter valid character");

        }
        else if (name.length <= 2) {
            printerror("name_error", "enter full name");

        } 
        else if (name.length >= 20) {
            printerror("name_error", "name not valid");

        }
        else {
            printerror("name_error", "");
            name_error = false;

        }

    }



    // ====================== e-mail validation ================================


if (email == ""){
    printerror("email_error","blankspace not allowed")
}
else{
    var regress = /^\S+@\S+\.\S+$/;

    if(regress.test(email)=== false){
        printerror("email_error","enter valid email address")
    }
 else {
    printerror("email_error" , "")
    email_error = false ; 
 }

}



// ====================== phonenumber validation========================

if(pnumber ==""){
    printerror("pnumber_error", "blank space not allowed")
}
else{
    var regex= /^[1-9]\d{9}$/;
    if(regex.test(pnumber) === false){
        printerror("pnumber_error","phone.number must be of 10 digits")
    }
    else{
        printerror("pnumber_error" , "")
        pnumber_error = false;
    }
}

// ==================== password validation =======================

if(password ==""){
    printerror("password_error", "blankspace not allowed")
}
else{
    if(password.length < 6){
        printerror("password_error" , "enter atleast 6 characters");
    }
    else{
        printerror("password_error" , "")
        password_error = false ;
    }
}

if(img ==""){
    printerror("img_error", "image not selected")
}   
 else{
    printerror("img_error" , "")
    img_error = false ;
}

    if ((name_error || email_error || pnumber_error || password_error  || img_error) == true) {
        return false 
    }



}


const selectImage = document.querySelector('.select-image');
const inputFile = document.querySelector('#file');
const imgArea = document.querySelector('.img-area');

selectImage.addEventListener('click', function () {
	inputFile.click();
})

inputFile.addEventListener('change', function () {
	const image = this.files[0]
		const reader = new FileReader();
		reader.onload = ()=> {
			const allImg = imgArea.querySelectorAll('img');
			allImg.forEach(item=> item.remove());
			const imgUrl = reader.result;
			const img = document.createElement('img');
			img.src = imgUrl;
			imgArea.appendChild(img);
			imgArea.classList.add('active');
			imgArea.dataset.img = image.name;
		}
		reader.readAsDataURL(image);
})
const tooglepassword = document.querySelector("#togglePassword");
const password1 = document.querySelector("#password");
tooglepassword.addEventListener("click" , function(){
    const type = password1.getAttribute("type")=== "password" ? "text" :"password";
    password1.setAttribute("type",type );
    this.classList.toggle("bi-eye")
})
