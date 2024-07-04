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





/***************************************REGISTRATION PAGE***************************************/
function showSecond() {
    const form = document.getElementById('regi-form');
    if (validateFirstStep(form)) {
        document.querySelector('.reg-first').classList.add('hidden');
        document.querySelector('.reg-second').classList.remove('hidden');
    }
}

function showFirst() {
    document.querySelector('.reg-second').classList.add('hidden');
    document.querySelector('.reg-first').classList.remove('hidden');
}
/***************************************REGISTRATION PAGE***************************************/





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





/***************************************REGISTRATION VALIDATION***************************************/
function validateFirstStep(form) {
    const name = form['reg-name'].value;
    const date = form['reg-date'].value;
    const gender = form['reg-gen'].value;
    const picture = form['reg-prof'].files[0];

    if (name.length < 5) {
        alert('Full Name must be at least 5 characters.');
        return false;
    }
    if (!date) {
        alert('Birthday is required.');
        return false;
    }
    if (!gender) {
        alert('Gender is required.');
        return false;
    }
    if (!picture) {
        alert('Profile picture is required.');
        return false;
    }
    const validExtensions = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!validExtensions.includes(picture.type)) {
        alert('Profile picture must be in JPG, PNG, or JPEG format.');
        return false;
    }

    return true;
}

function validateSecondStep(form) {
    const region = form['reg-regi'].value;
    const province = form['reg-prov'].value;
    const email = form['reg-email'].value;
    const password = form['reg-pword'].value;
    const confirmPassword = form['reg-cpword'].value;

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
/***************************************REGISTRATION VALIDATION***************************************/





/***************************************LISTENERS VALIDATION***************************************/
document.addEventListener('DOMContentLoaded', function() {
    const regiForm = document.getElementById('regi-form');
    if (regiForm) {
        regiForm.addEventListener('submit', function(event) {
            const form = event.target;
            if (!(validateFirstStep(form) && validateSecondStep(form))) {
                event.preventDefault();
            }
        });
    }
});
/***************************************LISTENERS VALIDATION***************************************/