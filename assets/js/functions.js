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
                let clip = document.createElement('a');
                clip.href = 'assets/wav/' + file.name;
                clip.className = 'list-group-item list-group-item-action audio-file';
                clip.innerHTML = file.name;

                document.querySelector('.list-group').appendChild(clip);
                playAudio();
            }).catch(error => {
                console.error(error);
            });
        }
    });

    function playAudio() {
        const clips = document.querySelectorAll('.audio-file');

        clips.forEach(function(clip) {
            clip.addEventListener('click', event => {
                event.preventDefault();

                const audio = new Audio(clip.href);
                audio.play();
            });
        });
    }

    playAudio();
});