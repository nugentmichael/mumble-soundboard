document.addEventListener("DOMContentLoaded", function(event) {
    // Search Functionality
    const search = document.querySelector('.audio-search');
    const searchBtn = document.querySelector('.audio-search-btn');
    const list = document.querySelector('#sound-clips .list-group');
    let link = list.getElementsByTagName('a');
    let filter, textValue;

    search.addEventListener('keyup', event => {
        event.preventDefault();
        audioSearch();
    });

    search.addEventListener('submit', event => {
        event.preventDefault();
        audioSearch();
    });

    searchBtn.addEventListener('click', event => {
        event.preventDefault();
        audioSearch();
    });

    function audioSearch() {
        filter = search.value.toUpperCase();

        for (let i = 0; i < link.length; i++) {
            textValue = link[i].textContent || link[i].innerText;

            if (textValue.toUpperCase().indexOf(filter) > -1) {
                link[i].style.display = "";
            } else {
                link[i].style.display = "none";
            }
        }
    }

    // Upload Functionality
    const url = 'index.php';
    const audioForm = document.getElementById('audio-upload');

    audioForm.addEventListener('submit', event => {
        event.preventDefault();

        const files = document.querySelector('[type=file]').files;
        const formData = new FormData();
        const sound = document.querySelectorAll('.audio-file');

        for (let i = 0; i < files.length; i++) {
            file = files[i];
            formData.append('files[]', file);

            fetch(url, {
                method: 'POST',
                body: formData,
            }).then(function() {
                for (let j = 0; j < sound.length; j++) {
                    if (sound[j].textContent === file.name || sound[j].innerText === file.name) {
                        return;
                    }
                }

                let clip = document.createElement('a');
                clip.href = 'assets/wav/' + file.name;
                clip.className = 'list-group-item list-group-item-action audio-file';
                clip.innerHTML = file.name;

                document.querySelector('.list-group').appendChild(clip);
                document.querySelector('[type=file]').value = "";
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