document.addEventListener("DOMContentLoaded", function(event) {
    // Search Functionality
    // var input, filter, table, tr, td, i, txtValue;
    // input = document.getElementById("myInput");
    // filter = input.value.toUpperCase();
    // table = document.getElementById("myTable");
    // tr = table.getElementsByTagName("tr");
    // for (i = 0; i < tr.length; i++) {
    //     td = tr[i].getElementsByTagName("td")[0];
    //     if (td) {
    //         txtValue = td.textContent || td.innerText;
    //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //             tr[i].style.display = "";
    //         } else {
    //             tr[i].style.display = "none";
    //         }
    //     }
    // }

    const search = document.querySelector('.audio-search');
    const filter = search.value.toUpperCase();
    const list = document.querySelector('#sound-clips .list-group');
    let link = list.getElementsByTagName('a');
    let textValue;

    search.addEventListener('keyup', event => {
        // event.preventDefault();

        for (let i = 0; i < link.length; i++) {
            textValue = link[i].textContent || link[i].innerText;

            if (textValue.toUpperCase().indexOf(filter) > -1) {
                link[i].style.display = "";
            } else {
                link[i].style.display = "none";
            }
        }
    });

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