const video = document.querySelector('#captureVideo');
const camera = document.querySelector('#camera');
const cameraContainer = document.querySelector('#capture');
const closeCamera = document.querySelector('#closeCamera')


camera.addEventListener('click', () => {
    cameraContainer.style.display = 'block';
    closeCamera.style.display = 'block'
    navigator.getUserMedia = navigator.getUserMedia || navigator.mozGetUserMedia || navigator.webkitGetUserMedia;

    navigator.getUserMedia({

            video: true,
            audio: true

        }, function(stream) {
            // video.src = window.URL.createObjectURL(stream);
            // latest objecturl change 
            video.srcObject = stream;

            video.play();
            closeCamera.addEventListener('click', function() {
                stream.stop();
                // video.src = window.URL.revokeObjectURL(stream);
                cameraContainer.style.display = 'none';
                closeCamera.style.display = 'none'




            })
        },
        function(err) {
            console.log(err)
        }
    )
});