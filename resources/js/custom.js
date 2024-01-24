
const cancelButton = document.querySelectorAll('#cancelButton');
const replyButton = document.querySelectorAll('#replyButton');
const submitButton = document.querySelectorAll('#submitButton');
const replyField = document.querySelectorAll('#mainReply');
const theFieldOfReply = document.querySelectorAll('#repField');
const theReplyForm = document.querySelectorAll('.theFormOfReply');
const nullError = document.querySelectorAll('#nullError');


for (var counter = 0; counter < replyButton.length; counter++){
    const data = counter;

    replyButton[counter].addEventListener('click', function (){
        replyField[data].style.display = 'inline';
        theFieldOfReply[data].focus();
        theFieldOfReply[data].style.borderBottomColor = 'rgba(0, 0, 0, 0.38)';
        replyButton[data].style.display = 'none';
        cancelButton[data].style.display = 'inline';
        submitButton[data].style.display = 'inline';
    })

    cancelButton[counter].addEventListener('click', function (){
        nullError[data].style.display = 'none'
        replyField[data].style.display = 'none';
        cancelButton[data].style.display = 'none';
        submitButton[data].style.display = 'none';
        replyButton[data].style.display = 'inline';
    })

    submitButton[counter].addEventListener('click', function (e){

        if (theFieldOfReply[data].value === ''){
            theFieldOfReply[data].style.borderBottomColor = 'rgba(255, 0, 0, 0.38)';
            nullError[data].style.color = 'rgba(255, 0, 0, 0.50)';
            nullError[data].style.display = 'block';
        }else {
            theReplyForm[data].submit();
        }
        theFieldOfReply[data].value = '';
    })
}


