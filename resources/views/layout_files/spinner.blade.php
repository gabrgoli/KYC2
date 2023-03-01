<!-- <div id="overlay" class="spinner_overlay hidden">
    <div id="spinner" class="spinner_wheel"></div>
</div> -->

<div class="spinner-border hidden"></div>

@push('scripts')
    <script>
        /*
        var counter = 0;

        function spin(timestamp) {
            var frames = 19;
            var frameWidth = 30;
            var offset = counter * -frameWidth;
            document.getElementById("spinner").style.backgroundPosition = 0 + "px" + " " + offset + "px";
            counter++;
            if (counter >= frames) counter = 0;
            requestAnimationFrame(spin);
        }

        $(document).ready(function() {
            $("a").on('click', showspinner);
            requestAnimationFrame(spin);
        });

        function showspinner() {
            var obj = document.getElementById("overlay");
            obj.classList.remove('hidden');
        }
        */
    </script>
@endpush
