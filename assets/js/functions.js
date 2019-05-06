document.addEventListener("DOMContentLoaded", function(event) {
    const url = 'index.php';
    const audioForm = document.getElementById('audio-upload');

    audioForm.addEventListener('submit', event => {
        event.preventDefault();

        const files = document.querySelector('[type=file]').files;
        const formData = new FormData();

        for (let i = 0; i < files.length; i++) {
            file = files[i];
            formData.append('files[]', file);

            fetch(url, {
                method: 'POST',
                body: formData,
            }).then(function() {
                let track = document.createElement('a');
                track.href = file.name;
                track.className = 'list-group-item list-group-item-action audio-file';
                track.innerHTML = file.name;

                document.querySelector('.list-group').appendChild(track);
            }).catch(error => {
                console.error(error);
            });
        }
    });

    const clips = document.querySelectorAll('.audio-file');

    clips.forEach(function(clip) {
        clip.addEventListener('click', event => {
            event.preventDefault();

            const audio = new Audio(clip.href);
            audio.play();
        });
    });
});