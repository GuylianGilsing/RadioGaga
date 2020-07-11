document.addEventListener('DOMContentLoaded', () => {
    // This function will run at every page and gets fired when the page has all of its contents loaded
    
    InitializeAwaitedVideos();
});

function InitializeAwaitedVideos()
{
    let videoTags = document.querySelectorAll(`video.await-playing`);
    if(videoTags.length > 0)
    {
        for(let tag of videoTags)
        {
            // Start the video
            tag.play();
            tag.classList.remove('await-playing');
        }
    }
}