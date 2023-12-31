import $ from 'jquery';

class Search {
    constructor(){
        this.addSearchHTML();
        this.resultsDiv = $('#search-overlay__results');
        this.openButton = $('.js-search-trigger');
        this.closeButton = $('.search-overlay__close');
        this.searchOverlay = $('.search-overlay');
        this.searchField = $('#search-term');
        this.events();
        this.isOverlayActive = false;
        this.isSpinnerVisible = false;
        this.typingTimer;
        this.previousValue;
    }

    events(){
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keydown", this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }

    typingLogic(){
        if(this.searchField.val() != this.previousValue){
            clearTimeout(this.typingTimer);

            if(this.searchField.val()){
                if(!this.isSpinnerVisible){
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 800);

            }else{
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }

        }

        this.previousValue = this.searchField.val();
    }
    
    getResults(){

        $.when(
            $.getJSON(universityData.root_url + `/wp-json/wp/v2/posts?search=${this.searchField.val()}`),
            $.getJSON(universityData.root_url + `/wp-json/wp/v2/pages?search=${this.searchField.val()}`),
        ).then((posts, pages)=>{
            let combinedResults = posts[0].concat(pages[0]);
            this.resultsDiv.html(`
            <h2 class="search-overlay__section-title">General Information</h2>
            ${combinedResults.length?'<ul class="link-list min-list">':'<p>No General information</p>'}

                ${combinedResults.map(item=> `<li><a href="${item.link}">${item.title.rendered} ${item.type == 'post'?`by ${item.authorName}`:''}</a></li>`).join('')}                
            
            ${combinedResults.length?'<ul>':''}
            `);
            this.isSpinnerVisible = false;

        }, ()=>{
            this.resultsDiv.html("<p>Unexpected Error Please Try Again</p>");
        });

    }

    keyPressDispatcher(e){
        if(e.keyCode == 83 && !this.isOverlayActive){
            this.openOverlay();
            console.info(e.keyCode);    
        }else if(e.keyCode == 27 && this.isOverlayActive){
            this.closeOverlay();
        }
    }

    openOverlay(){
        this.searchField.val('');
        this.resultsDiv.html('');
        this.searchOverlay.addClass("search-overlay--active");
        $('body').addClass('body-no-scroll');
        setTimeout(()=>{this.searchField.focus()},301);
        this.isOverlayActive = true;
    }
    
    closeOverlay(){
        this.searchOverlay.removeClass("search-overlay--active");
        $('body').removeClass('body-no-scroll');
        this.isOverlayActive = false;
    }

    addSearchHTML(){
        $('body').append(
            `
            <div class="search-overlay">
                <div class="search-overlay__top">
                <div class="container">
                    <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                    <input type="text" name="searchterm" id="search-term" class="search-term" placeholder="What are you looking for?">
                    <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                </div>
                </div>
                <div class="container">
                <div id="search-overlay__results"></div>
                </div>
            </div>
            `
        )
    }
}

export default Search;