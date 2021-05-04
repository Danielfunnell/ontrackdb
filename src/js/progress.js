progress();

function progress() {
const progressBar = document.querySelectorAll('.progress-bar');

progressBar.forEach(function(bar) {
    let barValue = bar.innerHTML;
    if (barValue == '%' || barValue == '20%' || barValue == '40%' ) {
        bar.classList.remove('bg-primary');
        bar.classList.add('progress-color-started');
      } else if (barValue == '60%' || barValue == '80%') {
        bar.classList.remove('bg-primary');
        bar.classList.add('progress-color-inter');
      } else {
        bar.classList.remove('bg-primary');
        bar.classList.add('progress-color-indi');
      }
    
});

};

export {progress};