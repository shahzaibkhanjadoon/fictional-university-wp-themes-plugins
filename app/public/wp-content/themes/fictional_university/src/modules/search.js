import $ from 'jquery';
// class starts here 
class search {
    // 1: initiat object 
constructor(){
 this.openbutton= $(".js-search-trigger");
 this.closebutton=$(".search-overlay__close");
 this.overlay=$(".search-overlay");
 this.searchfield=$("#search-term");
 this.searchresult=$("#search_content");
 this.events();
 this.isoverlayopen=false;
 this.previousvalue;
 this.isloadervisible=false;
 this.searchtimer;
}

// 2: Events 
events()
{
 this.openbutton.on("click",this.openoverlay.bind(this));
 this.closebutton.on("click",this.closeoverlay.bind(this));
 $(document).on("keydown",this.keypressevent.bind(this));
 this.searchfield.on("keyup",this.searchlogic.bind(this));
}

// 3: methods/ funcitons / actions 

openoverlay()
{
this.overlay.addClass("search-overlay--active");
$("body").addClass("body-no-scroll");
this.searchfield.val('');
setTimeout(()=>this.searchfield.focus(),301);
this.isoverlayopen=true;
}
closeoverlay()
{
this.overlay.removeClass("search-overlay--active");
$("body").removeClass("body-no-scroll");
this.isoverlayopen=false;
}
keypressevent(e){
    if(e.keyCode==83 && this.isoverlayopen==false && !$("input , textarea").is(':focus')){
      this.openoverlay();
    }
    if(e.keyCode==27 && this.isoverlayopen==true)
    {
this.closeoverlay();
    }
}
// keypressevent ftn end 
// searchlogic ftn start 
searchlogic(){
    if(this.previousvalue != this.searchfield.val())
   {
        clearTimeout(this.searchtimer);
        if(this.searchfield.val())
        {
            if(this.isloadervisible==false)
                {
                    this.searchresult.html('<div class="spinner-loader"></div>');
                    this.isloadervisible=true;
                }
                this.searchtimer=setTimeout(this.searchedcontent.bind(this), 750);
        }
        else
        {
            this.searchresult.html('');
        }
        
    }
    
    this.previousvalue=this.searchfield.val();
}

// this is responsible for content in searcharea
searchedcontent()
{

   $.when($.getJSON(universitydata.root_url + '/wp-json/wp/v2/posts?search='+this.searchfield.val()),$.getJSON(universitydata.root_url + '/wp-json/wp/v2/pages?search='+this.searchfield.val())).then((postdata,pagedata)=>{
    var combineresults= postdata[0].concat(pagedata[0]);
    this.searchresult.html(`
        <h2 class="search-overlay__section-title">General Information</h2>
        ${combineresults.length ? `<ul class="link-list min-list">` : `<p>Nothing Found for your search</p>`}
        ${combineresults.map(item=>`<li><a href="${item.link}">${item.title.rendered} </a> &nbsp; ${item.type=='post' ? `by ${item.authorName}` : ''}</li>`).join('')}
        ${combineresults.length ? `</ul>` : ``}
        `);
        this.isloadervisible=false;
   }, ()=>{
    this.searchresult.html('<p>Unexpected error; Please try again later.</p>');
   });
  
}
// searchedcontent ftn end 
} 
// class ends here 

export default search