var postId = 0;
var postBodyElement = null; 

$('.post').find('.interaction').find('.edit').on('click', function(event) {
    event.preventDefault();
    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $('#post-body').val(postBody);
    $('#editmodal').modal();
});

$('#modal-save').on('click', function () {
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: {body: $('#post-body').val(), postId: postId, _token: token}
    })
    .done(function (msg) {
        $(postBodyElement).text(msg['new_body']);
        $('#editmodal').modal('hide'); 
    });
    
   
});

   $('.like').on('click', function(event) {
       
       event.preventDefault();
       postId = event.target.parentNode.parentNode.dataset['postid'];
       var isLike = event.target.previousElementSibling == null;
       $.ajax({
           method: 'POST',
           url: urlLike,
           data: {isLike: isLike, postId: postId, _token: token}
             })
       .done(function() {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
           if (isLike) {
               event.target.nextElementSibling.innerText = 'Dislike';
               
           }
           else {
               event.target.previousElementSibling.innerText = 'Like';
           }
           
           
       });
});

 var updateChirpStats = {
    
            'Like': function (postId) {
                document.querySelector('#likes-count-' + postId).textContent++; 
            }, 
     
            'Dislike': function(postId) {
                document.querySelector('#dislikes-count-' + postId).textContent++;
            },
            
     
            'You don\'t like this post': function (postId) {
                document.querySelector('#dislikes-count-' + postId).textContent--;
            },

            'You like this post': function(postId) {
                document.querySelector('#likes-count-' + postId).textContent--;
            }
            
            
            
    
 };

/*
        var toggleButtonText = {
            Like: function(button) {
                button.textContent = "Unlike";
            },

            Dislike: function(button) {
                button.textContent = "Like";
            }
        };
*/
        var actOnChirp = function (event) {
            var postId = event.target.dataset.postId;
            var action = event.target.textContent;
       //     toggleButtonText[action](event.target);
            updateChirpStats[action](postId);
            axios.post('/dashboard/' + postId + '/act',
                { action: action });
        };


