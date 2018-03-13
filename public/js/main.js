// toggle coment input form on click
var commentbtn = document.querySelectorAll('.comment');
var commentInput = document.querySelectorAll('.commentForm');;

// loop through all commentbtn
for (let i = 0; i < commentbtn.length; i++) {
    commentbtn[i].addEventListener('click', function() {
        commentInput[i].classList.toggle('hiden');
    })
}


// toggle reply input form on click
var replybtn = document.querySelectorAll('.replybtn');
var replyInput = document.querySelectorAll('.replyForm');

// loop through all replybtn
for (let i = 0; i < replybtn.length; i++) {
    replybtn[i].addEventListener('click', function() {
        replyInput[i].classList.toggle('hiden');
    })
}


// showmore/less replies
var replies = document.querySelectorAll('.replies');
var viewReplies = document.querySelectorAll('.viewReplies');
var viewLess = document.querySelectorAll('.viewLess');

for (let i = 0; i < viewReplies.length; i++) {

    viewReplies[i].addEventListener('click', function() {

        this.classList.toggle('showLess');
        viewLess[i].classList.toggle('showMore');
        replies[i].classList.toggle('viewall');


    });

    viewLess[i].addEventListener('click', function() {

        this.classList.toggle('showMore');
        viewReplies[i].classList.toggle('showLess');
        replies[i].classList.toggle('viewall');


    });
}


// replies content height 

var replies = document.querySelectorAll('.replies');
for (let i = 0; i < replies.length; i++) {
    document.addEventListener('DOMContentLoaded', function(event) {
        console.log(event);
    })
}