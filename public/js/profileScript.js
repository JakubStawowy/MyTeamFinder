const commentTextArea = document.querySelector('.comment-text');
const commentSubmit = document.querySelector('.comment-submit');

function validateComment(){
    setTimeout(function () {
        if(commentTextArea.value.length>0){
            commentSubmit.classList.remove('button-disabled');
        }
        else{
            commentSubmit.classList.add('button-disabled');
        }
    }, 500)
}

commentTextArea.addEventListener('keyup', validateComment);