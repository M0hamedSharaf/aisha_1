function runVideo()
{
    let blanket = document.querySelector('.process-section .blanket')

    let videoElement = document.querySelector('.process-section .video')

    videoElement.addEventListener('click',function(){
        blanket.classList.add('active')
    })

    blanket.addEventListener('click',function(){
        blanket.classList.remove('active')
    })
}

runVideo()