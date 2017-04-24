jQuery('document').ready(function(){
    var grip;
    var rail;
    var startX;
    var railLength;
    var maxVal;
    var donationInput;
    init();
    window.addEventListener("resize", reset);

    function init(){
        initSlider();
        initInput();
        startX = rail[0].offsetLeft;
        railLength = rail[0].offsetWidth - grip[0].offsetWidth;
        maxVal = getMaxDonationValue();
    }

    function initInput(){
        donationInput = document.getElementById('donation-input');
        donationInput.addEventListener('input', onInputChange);
    }

    function initSlider(){
        grip = jQuery('#slide-grip').draggable({ containment: 'parent', axis: 'x' });
        rail = jQuery('#slide-rail');
        grip.on('drag', onSlideDrag);
    }

    function onSlideDrag(e){
        var currentX = e.target.offsetLeft - startX;
        var percent = currentX/railLength;
        donationInput.value = Math.round(percent * maxVal);

    }

    function onInputChange(){
        var inputVal = donationInput.value;
        if(inputVal !== ''){
            var percent = inputVal/maxVal;
            if(percent > 1){
                percent = 1;
            }
            var newXPosition = startX + (percent*railLength);
            grip.css('left', newXPosition);
        }

    }

    function getMaxDonationValue(){
        return (donationInput.max);
    }

    function reset(){
        donationInput.removeEventListener('input', onInputChange);
        grip.off('drag', onSlideDrag);
        grip.draggable("destroy");
        adjustGripTopPosition();
        init();
        onInputChange();
    }

    function adjustGripTopPosition(){
        var gripY = grip.css('top');
        var railY = rail[0].offsetTop;
        if(gripY !== railY){
            grip.css('top', railY);
        }
    }
});