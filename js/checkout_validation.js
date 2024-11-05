function validateFirstName(){
    const nameValidation = /^[a-zA-Z]+$/;
    var inputName = this.value;
    var validName = nameValidation.test(inputName);

    if (!validName){
        document.getElementById("errorFirstName").innerHTML = "No numbers or symbols allowed";
        this.focus();
        this.select();
        return false;
    }
    else
    {
        document.getElementById("errorFirstName").innerHTML ="";
        return true;
    }
}

function validateLastName(){
    const nameValidation = /^[a-zA-Z]+$/;
    var inputName = this.value;
    var validName = nameValidation.test(inputName);

    if (!validName){
        document.getElementById("errorLastName").innerHTML = "No numbers or symbols allowed";
        this.focus();
        this.select();
        return false;
    }
    else
    {
        document.getElementById("errorLastName").innerHTML ="";
        return true;
    }
}

function validateAddress(){
    const addressValidation = /^[a-zA-Z0-9\s,'#-]*$/;
    var inputAddress = this.value;
    var validAddress = addressValidation.test(inputAddress);

    if (!validAddress){
        document.getElementById("errorAddress").innerHTML = "Only letters, numbers, spaces, commas, and symbols # - ' allowed";
        this.focus();
        this.select();
        return false;
    }
    else
    {
        document.getElementById("errorAddress").innerHTML ="";
        return true;
    }
}

function validatePostalCode(){
    const postalCodeValidation = /^\d{6}$/;
    var inputPostalCode = this.value;
    var validPostalCode = postalCodeValidation.test(inputPostalCode);

    if (!validPostalCode){
        document.getElementById("errorPostalCode").innerHTML = "Only six-digit postal codes allowed";
        this.focus();
        this.select();
        return false;
    }
    else
    {
        document.getElementById("errorPostalCode").innerHTML ="";
        return true;
    }
}

function validateUnitCode(){
    const unitCodeValidation = /^[\d#-]*$/;
    var inputUnitCode = this.value;
    var validUnitCode = unitCodeValidation.test(inputUnitCode);

    if (!validUnitCode){
        document.getElementById("errorUnitCode").innerHTML = "Only numbers, # and hyphens allowed";
        this.focus();
        this.select();
        return false;
    }
    else
    {
        document.getElementById("errorUnitCode").innerHTML ="";
        return true;
    }
}

function formatCardNumber(input) {
    var value = input.value.replace(/\D/g, ''); //disable non-numeric input
    var formattedValue = value.replace(/(.{4})/g, '$1 '); //add space after every 4 digits
    formattedValue = formattedValue.trim(); //remove trailing whitespace
    input.value = formattedValue;
}

function validateCardNum(){
    const cardNumValidation = /^\d{16}$/;
    var inputCardNum = this.value.replace(/\s/g, '');
    var validCardNum = cardNumValidation.test(inputCardNum);

    if (!validCardNum){
        document.getElementById("errorCardNum").innerHTML = "Only sixteen-digit card numbers allowed";
        this.focus();
        this.select();
        return false;
    }
    else
    {
        document.getElementById("errorCardNum").innerHTML ="";
        return true;
    }
}

function validateCardExpiry(){
    const cardExpiryValidation = /^(1[1-2]\/24)|((0[1-9]|1[0-2])\/(2[5-9]|[3-9][0-9]))$/;
    var inputCardExpiry = this.value;
    var validCardExpiry = cardExpiryValidation.test(inputCardExpiry);

    if (!validCardExpiry){
        document.getElementById("errorCardExpiry").innerHTML = "Please enter date in the format MM/YY";
        this.focus();
        this.select();
        return false;
    }
    else
    {
        document.getElementById("errorCardExpiry").innerHTML ="";
        return true;
    }
}

function validateCardCVV(){
    const cardCVVValidation = /^\d{3}$/;
    var inputCardCVV = this.value;
    var validCardCVV = cardCVVValidation.test(inputCardCVV);

    if (!validCardCVV){
        document.getElementById("errorCardCVV").innerHTML = "Only three-digit CVV allowed";
        this.focus();
        this.select();
        return false;
    }
    else
    {
        document.getElementById("errorCardCVV").innerHTML ="";
        return true;
    }
}

function validateEmail(){
    const emailValidation = /^[\w.-]+@([\w]+\.){1,3}[\w]{2,3}$/;
    var inputEmail = this.value;
    var validEmail = emailValidation.test(inputEmail);

    if (!validEmail){
        document.getElementById("errorEmail").innerHTML = "Follow username@domain.xxx format, only - and . allowed";
        this.focus();
        this.select();
        return false;
    }
    else
    {
        document.getElementById("errorEmail").innerHTML ="";
        return true;
    }
}

function validatePhone(){
    const phoneValidation = /^(\+65)?\d{8}$/;
    var inputPhone = this.value;
    var validPhone = phoneValidation.test(inputPhone);

    if (!validPhone){
        document.getElementById("errorPhone").innerHTML = "Follow +65XXXXXXXX or 8-digit format";
        this.focus();
        this.select();
        return false;
    }
    else
    {
        document.getElementById("errorPhone").innerHTML ="";
        return true;
    }
}

function validateForm(){
    var validFirstName = validateFirstName.call(document.getElementById("firstname"));
    var validLastName = validateLastName.call(document.getElementById("lastname"));
    var validAddress = validateAddress.call(document.getElementById("address"));
    var validPostalCode = validatePostalCode.call(document.getElementById("postalcode"));
    var validUnitCode = validateUnitCode.call(document.getElementById("unitcode"));
    var validCardNum = validateCardNum.call(document.getElementById("cardnum"));
    var validCardExpiry = validateCardExpiry.call(document.getElementById("cardexpiry"));
    var validCardCVV = validateCardCVV.call(document.getElementById("cardcvv"));
    var validEmail = validateEmail.call(document.getElementById("email"));
    var validPhone = validatePhone.call(document.getElementById("phone"));

    if (validFirstName && validLastName && validAddress && validPostalCode && validUnitCode && validCardNum && validCardExpiry && validCardCVV && validEmail && validPhone){
        return true;
    }
    else
    {
        return false;
    }
}