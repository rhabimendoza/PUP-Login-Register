/***************************************INPUT BOX***************************************/
const input = document.querySelectorAll(".input-box");
const toggle = document.querySelectorAll(".toggle");
const main = document.querySelector("main");

input.forEach((inp) => {
    inp.addEventListener("focus", () => {
        inp.classList.add("active");
    });
  
    inp.addEventListener("blur", () => {
        if(inp.value != "")return;
        inp.classList.remove("active");
    });
});

toggle.forEach((btn) => {
    btn.addEventListener("click", () => {
        main.classList.toggle("activate");
    });
});
/***************************************INPUT BOX***************************************/



/***************************************ADDRESS SELECT***************************************/
let philippinesData;

fetch('res/philippines.json')
    .then(response => response.json())
    .then(data => {
    philippinesData = data;
    
    const regionSelect = document.getElementById('regionSelect');
    for (const regionKey in data) {
        const option = document.createElement('option');
        option.value = regionKey;
        option.textContent = data[regionKey].region_name;
        regionSelect.appendChild(option);
    }}).catch(error => console.error('Error loading JSON:', error));

function updateProvinceOptions() {
    const regionSelect = document.getElementById('regionSelect');
    const provinceSelect = document.getElementById('provinceSelect');
    
    provinceSelect.innerHTML = '<option value="">Select Province</option>';

    const regionKey = regionSelect.value;
    const region = philippinesData[regionKey];

    if (region && region.province_list) {
        for (const provinceKey in region.province_list) {
            const option = document.createElement('option');
            option.value = provinceKey;
            option.textContent = provinceKey;
            provinceSelect.appendChild(option);
        }
    } 
    else {
        console.error('Invalid region data:', region);
    }
}

document.getElementById('regionSelect').addEventListener('change', updateProvinceOptions);
/***************************************ADDRESS SELECT***************************************/



/***********************************************LOGIN***********************************************/

function validateLogIn(form) {
    const email = form['log-email'].value.trim();
    const password = form['log-pword'].value.trim();

    if (!email) {
        alert('Email is required.');
        return false;
    }
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert('Enter a valid email address.');
        return false;
    }
    if (password.length < 8) {
        alert('Password must be at least 8 characters.');
        return false;
    }

    return true;
}

function logAcc(event){
    const logForm = document.getElementById('log-form');
    
    if(validateLogIn(logForm)){
        logForm.submit();
    }
    else{
        event.preventDefault();
    }
}

/***********************************************LOGIN***********************************************/



/***********************************************REGISTER***********************************************/

function showFirst() {
    document.querySelector('.reg-second').classList.add('hidden');
    document.querySelector('.reg-first').classList.remove('hidden');
}

function showSecond() {
    document.querySelector('.reg-first').classList.add('hidden');
    document.querySelector('.reg-second').classList.remove('hidden');
}

function validateRegiOne(form) {
    const name = form['reg-name'].value.trim();
    const bdate = form['reg-bdate'].value.trim();
    const gender = form['reg-gen'].value;

    if (name.length < 5) {
        alert('Full Name must be at least 5 characters.');
        return false;
    }
    if (!bdate) {
        alert('Birthday is required.');
        return false;
    }
    if (!gender) {
        alert('Gender is required.');
        return false;
    }

    return true;
}

function validateRegiTwo(form) {
    const region = form['reg-regi'].value.trim();
    const province = form['reg-prov'].value.trim();
    const email = form['reg-email'].value.trim();
    const password = form['reg-pword'].value.trim();
    const confirmPassword = form['reg-cpword'].value.trim();

    if (!region || region === "Select Region") {
        alert('Region is required.');
        return false;
    }
    if (!province || province === "Select Province") {
        alert('Province is required.');
        return false;
    }
    if (!email) {
        alert('Email is required.');
        return false;
    }
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert('Enter a valid email address.');
        return false;
    }
    if (password.length < 8) {
        alert('Password must be at least 8 characters.');
        return false;
    }
    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true;
}

function regiAcc(event){
    const regiForm = document.getElementById('regi-form');
    
    if(validateRegiOne(regiForm) && validateRegiTwo(regiForm)){
        regiForm.submit();
    }
    else{
        event.preventDefault();
    }
}

/***********************************************REGISTER***********************************************/