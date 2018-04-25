var toggle = document.getElementById('woocommerce_conversionmonitor_conversionmonitor_enabled');
var website = document.getElementById('woocommerce_conversionmonitor_conversionmonitor_website');

toggle.insertAdjacentHTML('afterend', '<div class="conversionmonitor-confetti-button"></div>');

toggle.addEventListener('change', function() {
    var animation = document.getElementsByClassName('conversionmonitor-confetti-button')[0];

    if (this.checked) {
        animation.classList.remove('animate');

        animation.classList.add('animate');

        setTimeout(function(){
            animation.classList.remove('animate');
        },700);
    }
});

var fields = document.getElementsByClassName('conversionmonitor-input-token');

for (i = 0; i < fields.length; i++) {
    fields[i].setAttribute('maxlength', 32);
}

document.getElementById('woocommerce_conversionmonitor_conversionmonitor_website').addEventListener('change', function () {
    if (this.value.length !== 32) {
        return;
    }

    //document.getElementById('woocommerce_conversionmonitor_conversionmonitor_location').value = "eu-west-2";
});