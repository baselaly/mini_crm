const record = document.querySelector('.record');
const stop = document.querySelector('.stop');
const soundClips = document.querySelector('.sound-clips');
const recordState = document.querySelector('#recordState');
const loader = document.querySelector('.page-loader-wrapper');
const errorHolder = $('#error-container');
const messageHolder = $('#message-container');

let RecordFile = '';

record.onclick = function () {
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        console.log('getUserMedia supported.');
        navigator.mediaDevices.getUserMedia(
            // constraints - only audio needed for this app
            {
                audio: true
            })
            // Success callback
            .then(function (stream) {
                const mediaRecorder = new MediaRecorder(stream);
                mediaRecorder.start();
                console.log(mediaRecorder.state);
                console.log("recorder started");
                recordState.innerHTML = 'Recording.....'
                stop.disabled = false;
                record.disabled = true;

                let chunks = [];

                mediaRecorder.ondataavailable = function (e) {
                    chunks.push(e.data);
                }

                stop.onclick = function () {
                    mediaRecorder.stop();
                    console.log(mediaRecorder.state);
                    console.log("recorder stopped");
                    record.disabled = false;
                    stop.disabled = true;
                }

                mediaRecorder.onstop = function (e) {
                    console.log("recorder stopped");
                    recordState.innerHTML = 'Recording stopped , you may record new one by click Record';
                    const audio = document.createElement('audio');
                    const deleteButton = document.createElement('button');
                    deleteButton.innerHTML = "Delete";

                    audio.setAttribute('controls', '');
                    audio.style.verticalAlign = 'middle';
                    deleteButton.style.verticalAlign = 'middle'
                    deleteButton.style.margin = '0px 10px'
                    deleteButton.setAttribute('type', 'button')
                    soundClips.innerHTML = '';
                    soundClips.append(deleteButton);
                    soundClips.append(audio);

                    const blob = new Blob(chunks, { 'type': 'audio/ogg;' });
                    chunks = [];
                    const audioURL = window.URL.createObjectURL(blob);
                    audio.src = audioURL;
                    var fileObject = new File([blob], 'record', {
                        type: 'audio/ogg'
                    });
                    RecordFile = fileObject;
                    deleteButton.onclick = function (e) {
                        soundClips.innerHTML = '';
                        RecordFile = ''
                    }
                }
            })
            // Error callback
            .catch(function (err) {
                alert('The following getUserMedia error occured:');
            }
            );
    } else {
        alert('getUserMedia not supported on your browser!');
    }
}

$(".createButton").click(function (e) {
    e.preventDefault();
    showLoader();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });
    var formData = new FormData();
    formData.append('type', $('#type').val());
    formData.append('description', $('#description').val());
    formData.append('record', RecordFile)
    let api = $(this).parent('form').attr('action');
    $.ajax({
        url: api,
        data: formData,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (response) {
            document.documentElement.scrollTop = 0;
            console.log(response.message)
            appendMessage(response.message)
            hideLoader();
            document.documentElement.scrollTop = 0;
            setTimeout(function () {
                window.location.replace(response.redirect_url);
            }, 1000);
        },
        error: function (error) {
            console.log(error)
            let Error = error.responseJSON
            if (Error.errors && Array.isArray(Error.errors)) {
                appendErrors(Error.errors)
            } else {
                appendErrors([Error.message])
            }
            hideLoader();
            document.documentElement.scrollTop = 0;
        }
    });
    return false;
})

function showLoader() {
    loader.style.display = "block";
}

function hideLoader() {
    loader.style.display = "none";
}

function appendMessage(message) {
    messageHolder.innerHTML = '';
    messageHolder.show();
    errorHolder.hide();
    messageHolder.html(message)
}

function appendErrors(errors) {
    errorHolder.innerHTML = '';
    errorHolder.show()
    messageHolder.hide()
    errors.forEach(error => {
        console.log(error)
        errorHolder.append('<strong>' + error + '</strong><br>')
    });
}