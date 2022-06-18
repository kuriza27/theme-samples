jQuery(function($) {
	var filter_criteria = {};
	var readable_filter_criteria = {};

    let adminAjax = '/wp-admin/admin-ajax.php';
	loadMore1 = (e, filter = "") => {
        $("#loading").html("Loading...").show(), $.post(adminAjax, {
            action: "loadResearch",
            postType: "research",
            pg: e
        }, function(a) {
            a.entries ? ($("#results-area").append(a.entries), $("#loading").hide()) : $(".loading-pagination a,#loading").hide(), $(".list-main-container").removeClass("loading-jm")
        }, "json")
    }, loadMore1 = {
        cat: "",
        filter: "",
        tax: "",
        e: 1,
        isFilter: "",
        filter_criteria: {},
        empty: function() {
            return '<div class="no-entry"><strong>No Entry Found.</strong></div>'
        },
        load: function() {
            var a = {
                action: "loadResearch",
                postType: "research",
                pg: loadMore1.e,
                view: Cookies.get('table_view')
            };
            loadMore1.cat && (a.cat = loadMore1.cat), loadMore1.filter && (a.filter = loadMore1.filter), loadMore1.tax && (a.tax = loadMore1.tax), loadMore1.filter_criteria && (a.filter_criteria = loadMore1.filter_criteria), $.post(adminAjax, a, function(a) {
                // console.log(a.entries.length + "----"),  a.entries ? (loadMore1.isFilter ? $(".posts-list").html(a.entries) : $(".posts-list").append(a.entries), $(".loading-pagination a").show()) : loadMore1.isFilter && $(".posts-list").html(loadMore1.empty()), a.total < 9 && $(".loading-pagination a").hide(), $(".posts-list").removeClass("loading-jm"),$('span.totalpost').text(a.total);
                if( a.entries ){
                	console.log(loadMore1.isFilter);
                	if( loadMore1.isFilter ){
                		// block view
						$(".posts-list[data-view='block']").children(":not(nav)").remove();
                		$(a.entries).insertBefore( $(".posts-list[data-view='block'] .posts-navigation") );
                		// $(".posts-list").html(a.entries);

                		// list view
                		$(".posts-list[data-view='list']").empty();
                		$(".posts-list[data-view='list']").append(a.list_entries);
                	}
                	else {
                		// $(".posts-list").append(a.entries);
                		$(a.entries).insertBefore( $(".posts-list[data-view='block'] .posts-navigation") );

                		$(".posts-list[data-view='list']").append(a.list_entries);
                	}
                	$(".loading-pagination a").show();
                }
                else if( loadMore1.isFilter ){
                	$(".posts-list").html( loadMore1.empty() );
                }

                if( a.total < 12 ){
                	// $(".loading-pagination a").hide();
                	$(".posts-navigation").hide();
                }
                $(".posts-list").removeClass("loading-jm");
                $('span.totalpost').text(a.total);
                $('span.search-return-label').show();
            }, "json")
        }
    };
    a = 1;
    $(document).on("click", ".post-type-section .search-input-btn", e => {
        e.preventDefault();
        var val = $(".post-type-section .d-block input.search-by-title").val();
        $(".posts-list").addClass("loading-jm");
        // $("select").val("");
        currPage = 1;
        loadMore1.e = currPage;
        loadMore1.isFilter = 1;
        loadMore1.filter = val;
        loadMore1.filter_criteria = filter_criteria;
        loadMore1.load();
    }), 

    $(document).on("change", ".post-type-section select", e => {
        e.preventDefault(); 
        myThis = $(e.currentTarget);
        var val = myThis.val();
        var filter_txt = [];
        console.log($("option:selected", myThis));
        $.each( $("option:selected", myThis), function(i, obj){
        	filter_txt[i] = $(obj).text();
        });
        console.log(filter_txt);
        // $("select").val("");
        $(".post-type-section .d-block").val("");
        $(".posts-list").addClass("loading-jm");
        
        console.log($("option:selected", myThis).text());
        let name = myThis.attr("name").replace(/[\[\]']+/g,'');
        filter_criteria[name] = val;
        readable_filter_criteria[ '_' + name] = filter_txt;
        currPage = 1; 
        loadMore1.e = currPage; 
        loadMore1.isFilter = 1;
        loadMore1.filter_criteria = filter_criteria;

        var block_paginator = $(".posts-list nav.posts-navigation");
        var list_paginator = $(".mobile-space nav.posts-navigation");
        $(document).trigger("append_filters_to_pagination", [readable_filter_criteria, block_paginator]);
        $(document).trigger("append_filters_to_pagination", [readable_filter_criteria, list_paginator]);
        // loadMore1.tax = myThis.attr("name"); 
        // loadMore1.cat = val; 
        loadMore1.load();
        // myThis.val(val);
    })


    $('.icon-grid-view').click(function() {
        Cookies.set('table_view', 'grid-view',{ expires: 7 });
    });
    $('.icon-list-view').click(function() {
        Cookies.set('table_view', 'list-view',{ expires: 7 })
    });


    if(Cookies.get('table_view') != undefined){
        if( Cookies.get('table_view') == 'list-view' ){
            $(".display-grid-view").addClass("d-none")
            $(".display-list-view").removeClass("d-none")
        }
        else if( Cookies.get('table_view') == 'grid-view' ){
            $(".display-list-view").addClass("d-none")
            $(".display-grid-view").removeClass("d-none")
        }
    }

    $(".alert-covid button.close").on("click",function(){
        Cookies.set("covid_alert",1, {expires:60} );
    });
    
    $(".alert-covid a").on("click",function(){
        Cookies.set("covid_alert",1, {expires:60} );
    });

    if( Cookies.get('covid_alert') == 1 ){
        $(".alert-covid").hide();
    }

	var canBeLoaded = true;
	page = 1;
	$('.load-more-speech-btn').click(function(e){
        e.preventDefault();
        var post_type = $(this).parent().prev().data('post-type');
        var li_size = $(this).parent().siblings('li').length;
        var ul_sidebar = $(this).parents('ul.sidebar-list');
        var post_id_arr = [];
        var i=0;
        $(this).parent().siblings('li').each(function(){
            post_id_arr[i] = $(this).data('post-id');
            i++;
        });



        console.log(post_id_arr);
        $.ajax( {
            method: "POST",
            url:adminAjax,
            data:{
                action: 'custom_loadmore_speeches',
                paged: page,
                post_type: post_type ,
                posts_per_page : 3,
                posts_not_in: post_id_arr     
            },
            beforeSend: function( xhr ){
                // you can also add your own preloader here
                // you see, the AJAX call is in process, we shouldn't run it again until complete
                //var loader_src = $('.custom-gif-loader img').attr('data-src');
                //$('.custom-gif-loader img').attr('src',loader_src);
                ul_sidebar.css('opacity',0.3);
                canBeLoaded = false; 
            },
             success:function(data) {
                data = JSON.parse(data);
                 if(data){
                    canBeLoaded = true;
                    $('li.button-container').before(data.html);
                    ul_sidebar.css('opacity',1);
                    //$(".stories-section > .row > .columns.large-8").append(data);

                    if(page == data.max_num_pages){
                        $('.load-more-speech-btn').remove();
                    }
                    else{
                        page = page + 1;
                    }
                    //page = page + 1;
                 }                     
           }
        });
    });

	$(document).ready(function(){
		// $("#filterFields select").select2();

		$("#filterFields select[multiple], .horizontal-search select[multiple]").multiselect({
			numberDisplayed: 1
		});

		$("select[multiple]").on("change", function(e){
			let name = $(this).attr("name");
			var value = $(this).val();
			var others = $("select[name='"+name+"']").not(this);
			$(others).each(function(){
				$(this).val( value );
				$(this).multiselect('refresh');
			});
		});
	});
});