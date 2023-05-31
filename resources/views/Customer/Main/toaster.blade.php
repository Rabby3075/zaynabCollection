<style>
    #toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }
    .toast .progress-bar {
        animation: progress 5s linear;
    }

    @keyframes progress {
        from {
            width: 0%;
        }
        to {
            width: 100%;
        }
    }
</style>
@if (\Session::has('success'))
    <div id="toast-container">
        <div class="toast align-items-center text-white bg-success" role="alert"
             aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle"></i>
                    <label id="msg"></label>
                </div>
            </div>
        </div>
    </div>
@endif
@if (\Session::has('failed'))
    <div id="toast-container">
        <div class="toast align-items-center text-white bg-danger" role="alert"
             aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-exclamation-circle"></i>
                    <label id="msg"></label>
                </div>
            </div>
        </div>
    </div>
@endif
<script>
    function showToast(msg) {
        $('.toast').toast('show');
        $('#msg').text(msg);
        var toastElement = $('.toast:last');
        var toastInterval = setInterval(function() {
            var progressBar = toastElement.find('.toast-progress-bar');
            var currentTime = parseFloat(progressBar.attr('aria-valuenow'));
            var maxTime = parseFloat(progressBar.attr('aria-valuemax'));
            var percentage = Math.round((currentTime / maxTime) * 100);
            if (currentTime >= maxTime) {
                clearInterval(toastInterval);
                $('.toast').remove();
            } else {
                currentTime += 0.1; // Change the timer speed here
                progressBar.css('width', percentage + '%');
                progressBar.attr('aria-valuenow', currentTime.toFixed(1));
            }
        }, 100);
    }
</script>

