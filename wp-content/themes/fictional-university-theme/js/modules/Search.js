import $ from 'jquery';
//jquery  yükledik

class Search {
    //describe and initiate our object
    constructor() {
        this.addSearchHtml();
        //arama html ni yüklüyrz
        //sayfa açılır açılmaz class ve id isimlerine göre elementleri değişkenlere atyrz
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-term");
        this.resultsDiv = $("#search-overlay__results");

        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.typingTimer;

        this.events();

    }

    // events
    events () {
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));

        $(document).on("keyup", this.keyPressDispatcher.bind(this));
        //herhangi bir tuşa basıldığında keyPressDispatcher methodunu çağryrz.
        //on keyup hangi tuşa basıldığı bilgisini methoda iletiyor

        this.searchField.on("keyup", this.typingLogic.bind(this));
        //keydown ve keyup arasındaki fark keydown bir tuşa basıldığında, keyup bir tuşa basıp elimizi kaldırdığımızda
        //input field bir şey yazıldığında
        //bind(this) yaparak method içinde this çağırdığımızda searchField değil constructor içindeki değişkeni çağrmamıza izin veryr
    }


    // methods
    openOverlay () {
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        //setTimeout(function () {
        //    this.searchField.focus();
        //}, 301);
        this.searchField.val('');
        this.resultsDiv.html('');
        setTimeout( () => this.searchField.focus(), 301);
        this.isOverlayOpen = true;

        return false;
        //return false; bunu eğer borowserda js enabled sa search sayfası linki çalışmasın diye yaptık


    }

    closeOverlay () {
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        this.isOverlayOpen = false;

    }

    keyPressDispatcher (e) {
        //js de her tuşun bir kodu var. S harfinin kodu 83
        if(e.keyCode === 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
            this.openOverlay();
        }

        //js de her tuşun bir kodu var. esc harfinin kodu 27
        if(e.keyCode === 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    typingLogic() {
        if (this.searchField.val() !== this.previousValue) {
            clearTimeout(this.typingTimer);

            if(this.searchField.val()) {

                if(!this.isSpinnerVisible) {
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }

                this.typingTimer = setTimeout(this.getResults.bind(this), 750);
                //this.getResults ile aşağıdaki metodu 0,75 sn sonra çağryz

            } else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }


        }


        this.previousValue = this.searchField.val();
    }

    getResults () {
        $.getJSON(universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.val(), (results) => {
            this.resultsDiv.html(`
            <div class="row">
               <div class="one-third">
                  <h2 class="search-overlay__section-title">General Information</h2>
                  ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No item found</p>'}
                  ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType === 'post' ? `by ${item.authorName}`: ''} </li>`).join('')}
                  ${results.generalInfo.length ? '</ul>' : ''}
               </div>
               <div class="one-third">
                  <h2 class="search-overlay__section-title">Programs</h2>
                  ${results.programs.length ? '<ul class="link-list min-list">' : `<p>No item found. <a href="${universityData.root_url}/programs">View all programs</a></p>`}
                  ${results.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a> </li>`).join('')}
                  ${results.programs.length ? '</ul>' : ''}
                  <h2 class="search-overlay__section-title">Professors</h2>
                  ${results.professors.length ? '<ul class="professor-cards">' : `<p>No item found.</p>`}
                  ${results.professors.map(item => `
                    <li class="professor-card__list-item">
                    <a class="professor-card" href="${item.permalink}">
                        <img class="professor-card__image" src="${item.image}">
                        <span class="professor-card__name">
                            ${item.title}
                        </span>
                    </a>

                </li>
                  `).join('')}
                  ${results.professors.length ? '</ul>' : ''}
               </div>
               <div class="one-third">
                  <h2 class="search-overlay__section-title">Campuses</h2>
                  ${results.campuses.length ? '<ul class="link-list min-list">' : `<p>No item found. <a href="${universityData.root_url}/campuses">View all campuses</a></p>`}
                  ${results.campuses.map(item => `<li><a href="${item.permalink}">${item.title}</a> </li>`).join('')}
                  ${results.campuses.length ? '</ul>' : ''}
                  <h2 class="search-overlay__section-title">Events</h2>
                  ${results.events.length ? '' : `<p>No item found. <a href="${universityData.root_url}/events">View all events</a></p>`}
                  ${results.events.map(item => `
                     <div class="event-summary">
                       <a class="event-summary__date t-center" href="${item.permalink}">
                             <span class="event-summary__month">
                               ${item.month}
                             </span>
                             <span class="event-summary__day">${item.day}</span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}"> ${item.title} </a></h5>
                            <p>${item.description} <a href="${item.permalink}" class="nu gray">Learn more</a></p>
                        </div>
                      </div>
                  `).join('')}
                  
               </div>
            </div>
            `);
            this.isSpinnerVisible = false;
        })

    }
    //search-route.php içinde custom bir url olştrdk ve custom data yolladık


    /*
        getResults () {
            $.when(
                $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()),
                $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())
            ).then((posts, pages) => {
                var cobinedRsults = posts[0].concat(pages[0]);
                //iki arama sonucu array ini birleştrdk
                this.resultsDiv.html(`
                    <h2 class="search-overlay__section-title">General Information</h2>
                    ${cobinedRsults.length ? '<ul class="link-list min-list">' : '<p>No item found</p>'}
                    ${cobinedRsults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a> ${item.type === 'post' ? `by ${item.authorName}`: ''} </li>`).join('')}
                   ${cobinedRsults.length ? '</ul>' : ''}

                `);
                this.isSpinnerVisible = false;
            }, () => {
                this.resultsDiv.html('<p>Unexpected error: please try again.</p>');
            });
    //iki json requestini asekron yaptık





            // $.getJSON('http://fictional-university.test/wp-json/wp/v2/posts?search=' + this.searchField.val(), posts => {

            /*
            $.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val(), posts => {
    //function.php içinde universityData isminde bir object değişken tanımladık ve onun içindeki root_url kullndk

              $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val(), pages => {
                  var cobinedRsults = posts.concat(pages);
                  //iki arama sonucu array ini birleştrdk
                  this.resultsDiv.html(`
                    <h2 class="search-overlay__section-title">General Information</h2>
                    ${cobinedRsults.length ? '<ul class="link-list min-list">' : '<p>No item found</p>'}
                    ${cobinedRsults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
                   ${cobinedRsults.length ? '</ul>' : ''}

                `);
                  this.isSpinnerVisible = false;
              });

            });


        }

        */

    addSearchHtml() {
        $("body").append(`
           <div class="search-overlay">
     <div class="search-overlay__top">
         <div class="container">
             <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
             <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term" autocomplete="off">
             <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>

         </div>

     </div>

     <div class="container">
         <div id="search-overlay__results">

         </div>

     </div>
 </div>
        `);
    }
}
//restapi kullanarak search result aldık
// `` kullanarak js içinde html yazdık alt satıra geçerek. onun içinde tekrar js yazabilmek için ${} kullandık
// .map() js de yeni bir array olştrr ve içindedki item foreach gibi loop atar. burda itemı posts eşitledik. posts da arama sonucundaki
// json datasına eşit. sondaki join('') ile array sonunda boşluk bırakmasını söyledik istersek , veya - da yapablrz
export default Search;