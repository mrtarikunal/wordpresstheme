import $ from 'jquery';

class Like {

    constructor() {
        this.events();

    }

    events() {
        $(".like-box").on("click", this.ourClickDispatcher.bind(this));
        //bind ile tıklanan elemanı this e atamış olyrz

    }

    ourClickDispatcher(e) {
        var currentLikeBox = $(e.target).closest(".like-box");
        //burda e tıklanan elementi ifade edyr. burda tıklanan elemanın, .like-box class nı taşıyan parentı bul ve seç dyrz
        if(currentLikeBox.attr("data-exists") === 'yes') {
            //attr attribute her zaman değişen attribute ları algılar sayfa yüklendikten sonra bile olsa
            this.deleteLike(currentLikeBox);

        } else {
            this.createLike(currentLikeBox);
        }

    }

    createLike(currentLikeBox) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);

            },
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'POST',
            data: {
                'proffessorId' : currentLikeBox.data('proffessor')
            },
            success: (response) => {

                currentLikeBox.attr('data-exists', 'yes');
                var likeCount = parseInt(currentLikeBox.find(".like-count").html(),10);
                likeCount++;
                currentLikeBox.find(".like-count").html(likeCount);

                currentLikeBox.attr('data-like', response);
                //response da oluştrlan like post nun id si döner

                console.log("congs");
                console.log(response);

            },
            error: (response) => {

                console.log("sorry");
                console.log(response);
            },
        });

    }

    deleteLike(currentLikeBox) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);

            },
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'DELETE',
            data: {
                'like' : currentLikeBox.attr('data-like')
            },
            success: (response) => {

                currentLikeBox.attr('data-exists', 'no');
                var likeCount = parseInt(currentLikeBox.find(".like-count").html(),10);
                likeCount--;
                currentLikeBox.find(".like-count").html(likeCount);

                currentLikeBox.attr('data-like', '');

                console.log("congs");
                console.log(response);

            },
            error: (response) => {

                console.log("sorry");
                console.log(response);
            },
        });

    }
}

export default Like;