document.addEventListener("DOMContentLoaded", function(event) {
    const url = 'index.php';
    const audioForm = document.getElementById('audio-upload');

    audioForm.addEventListener('submit', event => {
        event.preventDefault();

        const files = document.querySelector('[type=file]').files;
        const formData = new FormData();

        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            formData.append('files[]', file);
        }

        fetch(url, {
            method: 'POST',
            body: formData,
        }).then(response => {
            console.log(response);
        });
    });

    const clips = document.querySelectorAll('.audio-file');

    clips.forEach(function(clip) {
        clip.addEventListener('click', function(event) {
            event.preventDefault();

            const audio = new Audio(this.href);
            audio.play();
        });
    });
});