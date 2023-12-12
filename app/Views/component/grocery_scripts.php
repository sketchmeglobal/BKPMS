    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- apps -->
    <script>
        function msg_receive(a){var e=new Date;return"<li class='msg_receive'><div class='chat-content'><div class='box bg-light-info'>"+a+"</div></div><div class='chat-time'>"+e.getHours()+":"+e.getMinutes()+"</div></li>"}function msg_sent(a){var e=new Date;return"<li class='odd msg_sent'><div class='chat-content'><div class='box bg-light-info'>"+a+"</div><br></div><div class='chat-time'>"+e.getHours()+":"+e.getMinutes()+"</div></li>"}$.fn.AdminSettings=function(t){var i=this.attr("id"),a=(t=$.extend({},{Theme:!0,Layout:"vertical",LogoBg:"skin1",NavbarBg:"skin6",SidebarType:"full",SidebarColor:"skin1",SidebarPosition:!1,HeaderPosition:!1,BoxedLayout:!1},t),{AdminSettingsInit:function(){a.ManageTheme(),a.ManageThemeLayout(),a.ManageThemeBackground(),a.ManageSidebarType(),a.ManageSidebarColor(),a.ManageSidebarPosition(),a.ManageBoxedLayout()},ManageTheme:function(){var a=t.Theme;switch(t.Layout){case"vertical":1==a?($("body").attr("data-theme","dark"),$("#theme-view").prop("checked",!0)):($("#"+i).attr("data-theme","light"),$("body").prop("checked",!1))}},ManageThemeLayout:function(){switch(t.Layout){case"horizontal":$("#"+i).attr("data-layout","horizontal");break;case"vertical":$("#"+i).attr("data-layout","vertical"),$(".scroll-sidebar").perfectScrollbar({})}},ManageThemeBackground:function(){var a,e;null!=(a=t.LogoBg)&&""!=a?$("#"+i+" .topbar .top-navbar .navbar-header").attr("data-logobg",a):$("#"+i+" .topbar .top-navbar .navbar-header").attr("data-logobg","skin1"),null!=(e=t.NavbarBg)&&""!=e?($("#"+i+" .topbar .navbar-collapse").attr("data-navbarbg",e),$("#"+i+" .topbar").attr("data-navbarbg",e),$("#"+i).attr("data-navbarbg",e)):($("#"+i+" .topbar .navbar-collapse").attr("data-navbarbg","skin1"),$("#"+i+" .topbar").attr("data-navbarbg","skin1"),$("#"+i).attr("data-navbarbg","skin1"))},ManageSidebarType:function(){switch(t.SidebarType){case"full":$("#"+i).attr("data-sidebartype","full");var a=function(){(0<window.innerWidth?window.innerWidth:this.screen.width)<1170?$("#main-wrapper").attr("data-sidebartype","mini-sidebar"):$("#main-wrapper").attr("data-sidebartype","full")};$(window).ready(a),$(window).on("resize",a),$(".sidebartoggler").on("click",function(){$("#main-wrapper").toggleClass("mini-sidebar"),$(".sidebartoggler i").toggleClass("mdi-toggle-switch-off"),$("#main-wrapper").hasClass("mini-sidebar")?($(".sidebartoggler").prop("checked",!0),$("#main-wrapper").attr("data-sidebartype","mini-sidebar")):($(".sidebartoggler").prop("checked",!1),$("#main-wrapper").attr("data-sidebartype","full"))});break;case"mini-sidebar":$("#"+i).attr("data-sidebartype","mini-sidebar"),$(".sidebartoggler").on("click",function(){$("#main-wrapper").toggleClass("mini-sidebar"),$(".sidebartoggler i").toggleClass("mdi-toggle-switch-off"),$("#main-wrapper").hasClass("mini-sidebar")?($(".sidebartoggler").prop("checked",!0),$("#main-wrapper").attr("data-sidebartype","full")):($(".sidebartoggler").prop("checked",!1),$("#main-wrapper").attr("data-sidebartype","mini-sidebar"))});break;case"iconbar":$("#"+i).attr("data-sidebartype","iconbar");a=function(){(0<window.innerWidth?window.innerWidth:this.screen.width)<1170?($("#main-wrapper").attr("data-sidebartype","mini-sidebar"),$("#main-wrapper").addClass("mini-sidebar")):($("#main-wrapper").attr("data-sidebartype","iconbar"),$("#main-wrapper").removeClass("mini-sidebar"))};$(window).ready(a),$(window).on("resize",a),$(".sidebartoggler").on("click",function(){$("#main-wrapper").toggleClass("mini-sidebar"),$(".sidebartoggler i").toggleClass("mdi-toggle-switch-off"),$("#main-wrapper").hasClass("mini-sidebar")?($(".sidebartoggler").prop("checked",!0),$("#main-wrapper").attr("data-sidebartype","mini-sidebar")):($(".sidebartoggler").prop("checked",!1),$("#main-wrapper").attr("data-sidebartype","iconbar"))});break;case"overlay":$("#"+i).attr("data-sidebartype","overlay");a=function(){(0<window.innerWidth?window.innerWidth:this.screen.width)<767?($("#main-wrapper").attr("data-sidebartype","mini-sidebar"),$("#main-wrapper").addClass("mini-sidebar")):($("#main-wrapper").attr("data-sidebartype","overlay"),$("#main-wrapper").removeClass("mini-sidebar"))};$(window).ready(a),$(window).on("resize",a),$(".sidebartoggler").on("click",function(){$("#main-wrapper").toggleClass("show-sidebar"),$("#main-wrapper").hasClass("show-sidebar")})}},ManageSidebarColor:function(){var a;null!=(a=t.SidebarColor)&&""!=a?$("#"+i+" .left-sidebar").attr("data-sidebarbg",a):$("#"+i+" .left-sidebar").attr("data-sidebarbg","skin1")},ManageSidebarPosition:function(){var a=t.SidebarPosition,e=t.HeaderPosition;switch(t.Layout){case"vertical":1==a?($("#"+i).attr("data-sidebar-position","fixed"),$("#sidebar-position").prop("checked",!0)):($("#"+i).attr("data-sidebar-position","absolute"),$("#sidebar-position").prop("checked",!1)),1==e?($("#"+i).attr("data-header-position","fixed"),$("#header-position").prop("checked",!0)):($("#"+i).attr("data-header-position","relative"),$("#header-position").prop("checked",!1))}},ManageBoxedLayout:function(){var a=t.BoxedLayout;switch(t.Layout){case"vertical":case"horizontal":1==a?($("#"+i).attr("data-boxed-layout","boxed"),$("#boxed-layout").prop("checked",!0)):($("#"+i).attr("data-boxed-layout","full"),$("#boxed-layout").prop("checked",!1))}}});a.AdminSettingsInit()},$(function(){$("#chat");$("#chat .message-center a").on("click",function(){var a=$(this).find(".mail-contnet h5").text(),e=$(this).find(".user-img img").attr("src"),t=$(this).attr("data-user-id"),i=$(this).find(".profile-status").attr("data-status");if($(this).hasClass("active"))$(this).toggleClass("active"),$(".chat-windows #user-chat"+t).hide();else if($(this).toggleClass("active"),$(".chat-windows #user-chat"+t).length)$(".chat-windows #user-chat"+t).removeClass("mini-chat").show();else{var r=msg_receive("I watched the storm, so beautiful yet terrific."),s="<div class='user-chat' id='user-chat"+t+"' data-user-id='"+t+"'>";s+="<div class='chat-head'><img src='"+e+"' data-user-id='"+t+"'><span class='status "+i+"'></span><span class='name'>"+a+"</span><span class='opts'><i class='ti-close closeit' data-user-id='"+t+"'></i><i class='ti-minus mini-chat' data-user-id='"+t+"'></i></span></div>",s+="<div class='chat-body'><ul class='chat-list'>"+(r+=msg_sent("That is very deep indeed!"))+"</ul></div>",s+="<div class='chat-footer'><input type='text' data-user-id='"+t+"' placeholder='Type & Enter' class='form-control'></div>",s+="</div>",$(".chat-windows").append(s)}}),$(document).on("click",".chat-windows .user-chat .chat-head .closeit",function(a){var e=$(this).attr("data-user-id");$(".chat-windows #user-chat"+e).hide(),$("#chat .message-center .user-info#chat_user_"+e).removeClass("active")}),$(document).on("click",".chat-windows .user-chat .chat-head img, .chat-windows .user-chat .chat-head .mini-chat",function(a){var e=$(this).attr("data-user-id");$(".chat-windows #user-chat"+e).hasClass("mini-chat")?$(".chat-windows #user-chat"+e).removeClass("mini-chat"):$(".chat-windows #user-chat"+e).addClass("mini-chat")}),$(document).on("keypress",".chat-windows .user-chat .chat-footer input",function(a){if(13==a.keyCode){var e=$(this).attr("data-user-id"),t=$(this).val();t=msg_sent(t),$(".chat-windows #user-chat"+e+" .chat-body .chat-list").append(t),$(this).val(""),$(this).focus()}$(".chat-windows #user-chat"+e+" .chat-body").perfectScrollbar({suppressScrollX:!0})}),$(".page-wrapper").on("click",function(a){$(".chat-windows").addClass("hide-chat"),$(".chat-windows").removeClass("show-chat")}),$(".service-panel-toggle").on("click",function(a){$(".chat-windows").addClass("show-chat"),$(".chat-windows").removeClass("hide-chat")})});
    </script>
    <script>
        $(function() {
            "use strict";
            $("#main-wrapper").AdminSettings({
                Theme: false, // this can be true or false ( true means dark and false means light ),
                Layout: 'vertical',
                LogoBg: 'skin5', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6 
                NavbarBg: 'skin6', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
                SidebarType: 'full', // You can change it full / mini-sidebar / iconbar / overlay
                SidebarColor: 'skin5', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
                SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
                HeaderPosition: true, // it can be true / false ( true means Fixed and false means absolute )
                BoxedLayout: false, // it can be true / false ( true means Boxed and false means Fluid ) 
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.10/js/perfect-scrollbar.jquery.js" integrity="sha512-jRagcyv20LBhAE1l2v5u/llNjxg+hAIZAeOFHGOtfHPm+r6hV8Y7pqO5ZrCMXDJcwM1N6GbTYjOPIF333ubq1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js" integrity="sha512-3PRVLmoBYuBDbCEojg5qdmd9UhkPiyoczSFYjnLhFb2KAFsWWEMlAPt0olX1Nv7zGhDfhGEVkXsu51a55nlYmw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--Menu sidebar -->
    <script>
        /*
      Template Name: Admin Template
      Author: Wrappixel

      File: js
      */
      // ============================================================== 
      // Auto select left navbar
      // ============================================================== 
$(function() {
    "use strict";
     var url = window.location + "";
        var path = url.replace(window.location.protocol + "//" + window.location.host + "/", "");
        var element = $('ul#sidebarnav a').filter(function() {
            return this.href === url || this.href === path;// || url.href.indexOf(this.href) === 0;
        });
        element.parentsUntil(".sidebar-nav").each(function (index)
        {
            if($(this).is("li") && $(this).children("a").length !== 0)
            {
                $(this).children("a").addClass("active");
                $(this).parent("ul#sidebarnav").length === 0
                    ? $(this).addClass("active")
                    : $(this).addClass("selected");
            }
            else if(!$(this).is("ul") && $(this).children("a").length === 0)
            {
                $(this).addClass("selected");
                
            }
            else if($(this).is("ul")){
                $(this).addClass('in');
            }
            
        });

    element.addClass("active"); 
    $('#sidebarnav a').on('click', function (e) {
        
            if (!$(this).hasClass("active")) {
                // hide any open menus and remove all other classes
                $("ul", $(this).parents("ul:first")).removeClass("in");
                $("a", $(this).parents("ul:first")).removeClass("active");
                
                // open our new menu and add the open class
                $(this).next("ul").addClass("in");
                $(this).addClass("active");
                
            }
            else if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this).parents("ul:first").removeClass("active");
                $(this).next("ul").removeClass("in");
            }
    })
    $('#sidebarnav >li >a.has-arrow').on('click', function (e) {
        e.preventDefault();
    });
    
});
    </script>
    <!--Custom JavaScript -->
    <script>
        $(function(){"use strict";$(".preloader").fadeOut(),$(".left-sidebar").hover(function(){$(".navbar-header").addClass("expand-logo")},function(){$(".navbar-header").removeClass("expand-logo")}),$(".nav-toggler").on("click",function(){$("#main-wrapper").toggleClass("show-sidebar"),$(".nav-toggler i").toggleClass("ti-menu")}),$(".search-box a, .search-box .app-search .srh-btn").on("click",function(){$(".app-search").toggle(200),$(".app-search input").focus()}),$(function(){$(".service-panel-toggle").on("click",function(){$(".customizer").toggleClass("show-service-panel")}),$(".page-wrapper").on("click",function(){$(".customizer").removeClass("show-service-panel")})}),$(".floating-labels .form-control").on("focus blur",function(e){$(this).parents(".form-group").toggleClass("focused","focus"===e.type||0<this.value.length)}).trigger("blur"),$(function(){$('[data-toggle="tooltip"]').tooltip()}),$(function(){$('[data-toggle="popover"]').popover()}),$(".message-center, .customizer-body, .scrollable").perfectScrollbar({wheelPropagation:!0}),$("body, .page-wrapper").trigger("resize"),$(".page-wrapper").delay(20).show(),$('a[data-action="collapse"]').on("click",function(e){e.preventDefault(),$(this).closest(".card").find('[data-action="collapse"] i').toggleClass("ti-minus ti-plus"),$(this).closest(".card").children(".card-body").collapse("toggle")}),$('a[data-action="expand"]').on("click",function(e){e.preventDefault(),$(this).closest(".card").find('[data-action="expand"] i').toggleClass("mdi-arrow-expand mdi-arrow-compress"),$(this).closest(".card").toggleClass("card-fullscreen")}),$('a[data-action="close"]').on("click",function(){$(this).closest(".card").removeClass().slideUp("fast")}),$(document).on("click",".mega-dropdown",function(e){e.stopPropagation()});var o,a=function(){$(".lastmonth").sparkline([6,10,9,11,9,10,12],{type:"bar",height:"35",barWidth:"4",width:"100%",resize:!0,barSpacing:"8",barColor:"#2961ff"})};$(window).resize(function(e){clearTimeout(o),o=setTimeout(a,500)}),a(),$(".show-left-part").on("click",function(){$(".left-part").toggleClass("show-panel"),$(".show-left-part").toggleClass("ti-menu")})});
    </script>
    <!--This page JavaScript -->