document.addEventListener("DOMContentLoaded", function(event) {
    const clips = document.querySelectorAll('.audio-file');

    clips.forEach(function(clip) {
        clip.addEventListener('click', function(event) {
            event.preventDefault();

            const audio = new Audio(this.href);
            audio.play();
        });
    });
});